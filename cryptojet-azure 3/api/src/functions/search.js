const { app } = require('@azure/functions');
const { sql, getPool } = require('../db');

app.http('search', {
    methods: ['GET'],
    authLevel: 'anonymous',
    route: 'search',
    handler: async (request, context) => {
        const q = request.query.get('q') || '';

        try {
            const pool = await getPool();
            const result = await pool.request()
                .input('q', sql.NVarChar, `%${q}%`)
                .query('SELECT cryptoId, coinCode, coinName FROM dbo.cryptocurrency WHERE coinName LIKE @q ORDER BY coinName ASC');
            return { status: 200, jsonBody: result.recordset };
        } catch (err) {
            context.error(err);
            return { status: 500, jsonBody: { error: 'Search failed' } };
        }
    }
});
