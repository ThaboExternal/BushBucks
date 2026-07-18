const { app } = require('@azure/functions');
const { sql, getPool } = require('../db');
const { getPrices } = require('../lib/prices');

app.http('wallet', {
    methods: ['GET'],
    authLevel: 'anonymous',
    route: 'wallet/{id}',
    handler: async (request, context) => {
        const id = parseInt(request.params.id, 10);
        if (!Number.isInteger(id)) {
            return { status: 400, jsonBody: { error: 'Invalid customer id' } };
        }

        try {
            const pool = await getPool();
            const result = await pool.request()
                .input('id', sql.Int, id)
                .query(`
                    SELECT cc.coinCode, w.balance
                    FROM dbo.wallet w
                    JOIN dbo.cryptocurrency cc ON cc.cryptoId = w.cryptoId
                    WHERE w.userId = @id
                `);

            const prices = await getPrices(context);

            const wallets = result.recordset.map(row => {
                const price = prices[row.coinCode] || 0;
                return {
                    coin: row.coinCode,
                    balance: Number(row.balance),
                    valueUsd: Number(row.balance) * price
                };
            });

            return { status: 200, jsonBody: { clientId: id, wallets } };
        } catch (err) {
            context.error(err);
            return { status: 500, jsonBody: { error: 'Unable to fetch wallet' } };
        }
    }
});
