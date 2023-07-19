// Import required modules
const fs = require('fs');
const { MongoClient } = require('mongodb');

// Connection URL and database name
const url = "mongodb+srv://architjain061001:dKGFhb6h6dLgeuWK@cluster0.cxi1i7j.mongodb.net/?retryWrites=true&w=majority";;
const dbName = 'stock_ticker';

// Create a new MongoClient
const client = new MongoClient(url);
var db = client.db(dbName);

// Create a collection called companies
var collection = db.collection('companies');

// Read the companies.csv file and insert each row into the collection
fs.readFile('companies.csv', 'utf8', (err, data) => {
    if (err) {
        throw err;
    }

    // Split the data into lines and insert each line as a document
    const lines = data.trim().split('\n');
    const documents = lines.slice(1, -1).map(line => {
      const [name, ticker, price] = line.split(/[,|\r]/, 3);
      if (!name || !ticker || !price) {
        console.log(`Invalid line: ${line}`);
        return null;
      }
      return { name, ticker, price: parseFloat(price) };
    }).filter(Boolean);

    // Insert the documents into the collection
    collection.insertMany(documents)
        .then(result => {
            console.log(`${result.insertedCount} documents were inserted`);
            client.close();
        })
        .catch(error => {
            console.log("Error received: " + error);
            client.close();
        });
});