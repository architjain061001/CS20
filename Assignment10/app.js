const express = require('express');
const app = express();
const { MongoClient } = require('mongodb');

// Connection URL and database name
const url = "mongodb+srv://architjain061001:dKGFhb6h6dLgeuWK@cluster0.cxi1i7j.mongodb.net/?retryWrites=true&w=majority";
const dbName = 'stock_ticker';

// Create a new MongoClient
const client = new MongoClient(url);
var db = client.db(dbName);

// Create a collection called companies
var collection = db.collection('companies');

// Set up the middleware to parse form data
app.use(express.urlencoded({ extended: true }));

// Route to handle the form submission
app.post('/lookup', async (req, res) => {
    const searchType = req.body.searchType;
    const searchInput = req.body.searchInput;

    // Define the query based on the search type
    let query;
    if (searchType === 'ticker') {
        query = { ticker: searchInput };
    } else {
        query = { name: { $regex: new RegExp(searchInput, 'i') } };
    }

    // Search for matching companies in the database
    try {
        const result = await collection.find(query).toArray();
      
        if (result.length === 0) {
          return res.send("No companies found");
        }
      
        const company = result[0];
        return res.send(`Name: ${company.name}<br>Ticker: ${company.ticker}<br>Price: ${company.price}`);
      
      } catch (err) {
        console.log("Error searching for companies:", err);
        return res.status(500).send("An error occurred while searching for companies");
      }      
});

// Serve the index.html file
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

// Start the server
app.listen(3000, () => {
    console.log("Server started on port 3000");
});
