const { app } = require('@azure/functions');
const bcrypt = require('bcryptjs');
const { sql, getPool } = require('../db');

app.http('register', {
    methods: ['POST'],
    authLevel: 'anonymous',
    route: 'register',
    handler: async (request, context) => {
        const body = await request.json().catch(() => null);
        if (!body) {
            return { status: 400, jsonBody: { error: 'Invalid JSON body' } };
        }

        const { firstName, lastName, username, password, email, phone, country, prefCoin } = body;

        if (!firstName || !lastName || !username || !password || !email || !phone || !country) {
            return { status: 400, jsonBody: { error: 'Missing required fields' } };
        }

        const passHash = await bcrypt.hash(password, 10);

        try {
            const pool = await getPool();
            const transaction = new sql.Transaction(pool);
            await transaction.begin();

            try {
                const request1 = new sql.Request(transaction);
                const insertCustomer = await request1
                    .input('fname', sql.NVarChar, firstName)
                    .input('lname', sql.NVarChar, lastName)
                    .input('username', sql.NVarChar, username)
                    .input('passHash', sql.NVarChar, passHash)
                    .input('email', sql.NVarChar, email)
                    .input('phoneNum', sql.NVarChar, phone)
                    .input('country', sql.NVarChar, country)
                    .input('prefCoin', sql.VarChar, prefCoin || 'BTC')
                    .query(`
                        INSERT INTO dbo.customer (fname, lname, username, passHash, email, phoneNum, country, prefCoin)
                        OUTPUT INSERTED.clientId
                        VALUES (@fname, @lname, @username, @passHash, @email, @phoneNum, @country, @prefCoin)
                    `);

                const clientId = insertCustomer.recordset[0].clientId;

                const coinsResult = await new sql.Request(transaction).query('SELECT cryptoId FROM dbo.cryptocurrency');
                for (const row of coinsResult.recordset) {
                    await new sql.Request(transaction)
                        .input('userId', sql.Int, clientId)
                        .input('cryptoId', sql.Int, row.cryptoId)
                        .query('INSERT INTO dbo.wallet (userId, cryptoId, balance) VALUES (@userId, @cryptoId, 0)');
                }

                await transaction.commit();
                return { status: 201, jsonBody: { clientId } };
            } catch (innerErr) {
                await transaction.rollback();
                throw innerErr;
            }
        } catch (err) {
            context.error(err);
            if (err.number === 2627 || err.number === 2601) {
                return { status: 409, jsonBody: { error: 'Username already exists' } };
            }
            return { status: 500, jsonBody: { error: 'Unable to register user' } };
        }
    }
});
