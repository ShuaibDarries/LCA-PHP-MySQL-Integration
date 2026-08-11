<template>
  <div id="app">
    <ProductList />
  </div>
</template>

<script setup>
import ProductList from './components/ProductList.vue'
</script>

<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 20px;
  background: #f5f5f5;
}
#app {
  max-width: 800px;
  margin: 0 auto;
}
</style>
