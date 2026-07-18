const { app } = require('@azure/functions');
const { getPrices } = require('../lib/prices');

app.http('prices', {
    methods: ['GET'],
    authLevel: 'anonymous',
    route: 'prices',
    handler: async (request, context) => {
        try {
            const prices = await getPrices(context);
            return { status: 200, jsonBody: prices };
        } catch (err) {
            context.error(err);
            return { status: 500, jsonBody: { error: 'Unable to fetch prices' } };
        }
    }
});
