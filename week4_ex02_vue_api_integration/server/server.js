const express = require('express');
const cors = require('cors');
const dotenv = require('dotenv');

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());

// In-memory products array
let products = [
  { id: 1, name: 'Wireless Headphones', price: 59.99 },
  { id: 2, name: 'Smart Watch', price: 129.99 },
  { id: 3, name: 'USB-C Cable', price: 12.99 }
];
let nextId = 4;

// GET /products
app.get('/products', (req, res) => {
  res.json(products);
});

// POST /products
app.post('/products', (req, res) => {
  const { name, price } = req.body;
  if (!name || price == null) {
    return res.status(400).json({ error: 'Name and price are required' });
  }
  const newProduct = { id: nextId++, name, price: Number(price) };
  products.push(newProduct);
  res.json(products);
});

// DELETE /products/:id
app.delete('/products/:id', (req, res) => {
  const id = parseInt(req.params.id, 10);
  products = products.filter(p => p.id !== id);
  res.json(products);
});

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
