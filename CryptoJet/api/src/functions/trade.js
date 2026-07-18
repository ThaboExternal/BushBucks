const { app } = require('@azure/functions');
const { sql, getPool } = require('../db');
const { getPrices, COINS } = require('../lib/prices');

app.http('trade', {
    methods: ['POST'],
    authLevel: 'anonymous',
    route: 'trade',
    handler: async (request, context) => {
        const body = await request.json().catch(() => null);
        if (!body) return { status: 400, jsonBody: { error: 'Invalid JSON body' } };

        const { clientId, coin, side, amountUsd } = body;
        const coinCode = (coin || '').toUpperCase();

        if (!Number.isInteger(clientId) || !COINS.includes(coinCode) || !['BUY', 'SELL'].includes(side) || !(amountUsd > 0)) {
            return { status: 400, jsonBody: { error: 'clientId, coin, side (BUY|SELL) and a positive amountUsd are required' } };
        }

        try {
            const prices = await getPrices(context);
            const rate = prices[coinCode];
            if (!rate) {
                return { status: 502, jsonBody: { error: 'Price unavailable for that coin right now' } };
            }
            const coinAmount = amountUsd / rate; // USD amount converted into units of the coin

            const pool = await getPool();
            const transaction = new sql.Transaction(pool);
            await transaction.begin();

            try {
                const walletRes = await new sql.Request(transaction)
                    .input('userId', sql.Int, clientId)
                    .input('coinCode', sql.VarChar, coinCode)
                    .query(`
                        SELECT w.walletId, w.balance, cc.cryptoId
                        FROM dbo.wallet w
                        JOIN dbo.cryptocurrency cc ON cc.cryptoId = w.cryptoId
                        WHERE w.userId = @userId AND cc.coinCode = @coinCode
                    `);

                if (walletRes.recordset.length === 0) {
                    await transaction.rollback();
                    return { status: 404, jsonBody: { error: 'Wallet not found for that user/coin' } };
                }

                const wallet = walletRes.recordset[0];
                const current = Number(wallet.balance);
                let newBalance;

                if (side === 'BUY') {
                    newBalance = current + coinAmount;
                } else {
                    if (current < coinAmount) {
                        await transaction.rollback();
                        return { status: 400, jsonBody: { error: 'Insufficient balance for this sell' } };
                    }
                    newBalance = current - coinAmount;
                }

                await new sql.Request(transaction)
                    .input('walletId', sql.Int, wallet.walletId)
                    .input('balance', sql.Decimal(28, 10), newBalance)
                    .query('UPDATE dbo.wallet SET balance = @balance WHERE walletId = @walletId');

                await new sql.Request(transaction)
                    .input('userId', sql.Int, clientId)
                    .input('cryptoId', sql.Int, wallet.cryptoId)
                    .input('amountUsd', sql.Decimal(28, 10), amountUsd)
                    .input('balance', sql.Decimal(28, 10), newBalance)
                    .input('descrip', sql.VarChar, side)
                    .query(`
                        INSERT INTO dbo.[transaction] (userId, cryptoId, amountUsd, balance, descrip, stat)
                        VALUES (@userId, @cryptoId, @amountUsd, @balance, @descrip, 1)
                    `);

                await transaction.commit();
                return { status: 200, jsonBody: { coin: coinCode, side, newBalance } };
            } catch (innerErr) {
                await transaction.rollback();
                throw innerErr;
            }
        } catch (err) {
            context.error(err);
            return { status: 500, jsonBody: { error: 'Trade failed' } };
        }
    }
});
