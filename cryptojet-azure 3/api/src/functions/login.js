const { app } = require('@azure/functions');
const bcrypt = require('bcryptjs');
const { sql, getPool } = require('../db');

app.http('login', {
    methods: ['POST'],
    authLevel: 'anonymous',
    route: 'login',
    handler: async (request, context) => {
        const body = await request.json().catch(() => null);
        if (!body || !body.username || !body.password) {
            return { status: 400, jsonBody: { error: 'username and password are required' } };
        }

        try {
            const pool = await getPool();
            const result = await pool.request()
                .input('username', sql.NVarChar, body.username)
                .query('SELECT clientId, passHash, fname, lname, prefCoin FROM dbo.customer WHERE username = @username');

            if (result.recordset.length === 0) {
                return { status: 401, jsonBody: { error: 'Invalid username or password' } };
            }

            const user = result.recordset[0];
            const match = await bcrypt.compare(body.password, user.passHash);

            if (!match) {
                return { status: 401, jsonBody: { error: 'Invalid username or password' } };
            }

            return {
                status: 200,
                jsonBody: {
                    clientId: user.clientId,
                    firstName: user.fname,
                    lastName: user.lname,
                    prefCoin: user.prefCoin
                }
            };
        } catch (err) {
            context.error(err);
            return { status: 500, jsonBody: { error: 'Login failed' } };
        }
    }
});
