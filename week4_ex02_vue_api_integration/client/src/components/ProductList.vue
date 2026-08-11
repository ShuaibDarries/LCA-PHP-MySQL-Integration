<template>
  <div class="product-catalogue">
    <h1>TechVibe Product Catalogue</h1>

    <!-- Add Product Form -->
    <div class="form-section">
      <h2>Add New Product</h2>
      <form @submit.prevent="addProduct">
        <div class="form-group">
          <label for="name">Product Name</label>
          <input id="name" v-model="newProduct.name" type="text" placeholder="Enter product name" required />
        </div>
        <div class="form-group">
          <label for="price">Price (R)</label>
          <input id="price" v-model.number="newProduct.price" type="number" step="0.01" placeholder="Enter price" required />
        </div>
        <button type="submit" class="btn-add">Add Product</button>
      </form>
    </div>

    <!-- Product List -->
    <div class="list-section">
      <h2>Products</h2>
      <p v-if="loading">Loading products...</p>
      <p v-else-if="error" class="error">{{ error }}</p>
      <p v-else-if="products.length === 0">No products available.</p>
      <ul v-else class="product-list">
        <li v-for="product in products" :key="product.id" class="product-item">
          <div class="product-info">
            <strong>{{ product.name }}</strong>
            <span>R{{ product.price.toFixed(2) }}</span>
          </div>
          <button @click="deleteProduct(product.id)" class="btn-delete">Delete</button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'

const API_URL = 'http://localhost:3000'

const products = ref([])
const loading = ref(false)
const error = ref('')

const newProduct = reactive({
  name: '',
  price: null
})

const fetchProducts = async () => {
  loading.value = true
  error.value = ''
  try {
    const res = await axios.get(`${API_URL}/products`)
    products.value = res.data
  } catch (err) {
    error.value = 'Failed to load products.'
    console.error(err)
  } finally {
    loading.value = false
  }
}

const addProduct = async () => {
  if (!newProduct.name || newProduct.price == null) return
  try {
    const res = await axios.post(`${API_URL}/products`, {
      name: newProduct.name,
      price: newProduct.price
    })
    products.value = res.data
    newProduct.name = ''
    newProduct.price = null
  } catch (err) {
    error.value = 'Failed to add product.'
    console.error(err)
  }
}

const deleteProduct = async (id) => {
  try {
    const res = await axios.delete(`${API_URL}/products/${id}`)
    products.value = res.data
  } catch (err) {
    error.value = 'Failed to delete product.'
    console.error(err)
  }
}

onMounted(() => {
  fetchProducts()
})
</script>

<style scoped>
.product-catalogue {
  background: #fff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h1 {
  color: #2c3e50;
  margin-bottom: 20px;
  text-align: center;
}

h2 {
  color: #34495e;
  margin-bottom: 15px;
  border-bottom: 2px solid #3498db;
  padding-bottom: 5px;
}

.form-section {
  margin-bottom: 30px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
  color: #555;
}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 1rem;
  box-sizing: border-box;
}

input:focus {
  outline: none;
  border-color: #3498db;
}

.btn-add {
  background: #27ae60;
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.2s;
}

.btn-add:hover {
  background: #219150;
}

.product-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.product-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  margin-bottom: 10px;
  background: #f9f9f9;
  border-radius: 8px;
  border-left: 4px solid #3498db;
}

.product-info {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.product-info strong {
  font-size: 1.1rem;
  color: #2c3e50;
}

.product-info span {
  color: #27ae60;
  font-weight: 600;
}

.btn-delete {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-delete:hover {
  background: #c0392b;
}

.error {
  color: #e74c3c;
  font-weight: 600;
}
</style>
