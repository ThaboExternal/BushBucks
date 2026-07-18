const sql = require('mssql');

let poolPromise;

function getPool() {
    if (!poolPromise) {
        const config = {
            server: process.env.SQL_SERVER,
            database: process.env.SQL_DATABASE,
            user: process.env.SQL_USER,
            password: process.env.SQL_PASSWORD,
            options: {
                encrypt: true,
                trustServerCertificate: false
            },
            pool: {
                max: 10,
                min: 0,
                idleTimeoutMillis: 30000
            }
        };
        poolPromise = new sql.ConnectionPool(config).connect();
    }
    return poolPromise;
}

module.exports = { sql, getPool };
