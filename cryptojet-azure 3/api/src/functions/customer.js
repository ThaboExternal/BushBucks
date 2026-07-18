const { app } = require('@azure/functions');
const { sql, getPool } = require('../db');

app.http('customer', {
    methods: ['GET', 'PUT', 'DELETE'],
    authLevel: 'anonymous',
    route: 'customer/{id}',
    handler: async (request, context) => {
        const id = parseInt(request.params.id, 10);
        if (!Number.isInteger(id)) {
            return { status: 400, jsonBody: { error: 'Invalid customer id' } };
        }

        const pool = await getPool();

        if (request.method === 'GET') {
            try {
                const result = await pool.request()
                    .input('id', sql.Int, id)
                    .query(`
                        SELECT c.clientId, c.fname, c.lname, c.email, c.phoneNum, c.country, c.prefCoin,
                               (SELECT COUNT(*) FROM dbo.wallet w WHERE w.userId = c.clientId) AS walletCount
                        FROM dbo.customer c
                        WHERE c.clientId = @id
                    `);
                if (result.recordset.length === 0) {
                    return { status: 404, jsonBody: { error: 'Customer not found' } };
                }
                return { status: 200, jsonBody: result.recordset[0] };
            } catch (err) {
                context.error(err);
                return { status: 500, jsonBody: { error: 'Unable to fetch customer' } };
            }
        }

        if (request.method === 'PUT') {
            const body = await request.json().catch(() => null);
            if (!body) return { status: 400, jsonBody: { error: 'Invalid JSON body' } };

            try {
                await pool.request()
                    .input('id', sql.Int, id)
                    .input('fname', sql.NVarChar, body.firstName)
                    .input('lname', sql.NVarChar, body.lastName)
                    .input('email', sql.NVarChar, body.email)
                    .input('phoneNum', sql.NVarChar, body.phone)
                    .input('country', sql.NVarChar, body.country)
                    .input('prefCoin', sql.VarChar, body.prefCoin)
                    .query(`
                        UPDATE dbo.customer
                        SET fname = @fname, lname = @lname, email = @email,
                            phoneNum = @phoneNum, country = @country, prefCoin = @prefCoin
                        WHERE clientId = @id
                    `);
                return { status: 200, jsonBody: { updated: true } };
            } catch (err) {
                context.error(err);
                return { status: 500, jsonBody: { error: 'Unable to update customer' } };
            }
        }

        if (request.method === 'DELETE') {
            try {
                await pool.request()
                    .input('id', sql.Int, id)
                    .query('DELETE FROM dbo.customer WHERE clientId = @id'); // wallet rows cascade
                return { status: 200, jsonBody: { deleted: true } };
            } catch (err) {
                context.error(err);
                return { status: 500, jsonBody: { error: 'Unable to delete customer' } };
            }
        }
    }
});
