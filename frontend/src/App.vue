<script setup>
import { ref, computed } from 'vue'
import BrandFilter from './components/BrandFilter.vue'
import VehicleList from './components/VehicleList.vue'

const vehicles = ref([
  { id: 1, brand: 'Peugeot', model: '308', version: 'GT Line', mileage: 42000, fuel: 'Diesel', price: 18900, photo_url: null },
  { id: 2, brand: 'Renault', model: 'Clio', version: 'Evolution', mileage: 15000, fuel: 'Essence', price: 16500, photo_url: null },
  { id: 3, brand: 'Peugeot', model: '2008', version: 'Allure', mileage: 30000, fuel: 'Essence', price: 21000, photo_url: null },
])
const selectedBrand = ref('')

const brands = computed(() => [...new Set(vehicles.value.map(v => v.brand))].sort())
const filtered = computed(() =>
    selectedBrand.value ? vehicles.value.filter(v => v.brand === selectedBrand.value) : vehicles.value
)
</script>

<template>
  <main class="page">
    <h1>Véhicules disponibles</h1>
    <BrandFilter v-model="selectedBrand" :brands="brands" />
    <VehicleList :vehicles="filtered" />
  </main>
</template>

<style>
body { margin: 0; font-family: system-ui, sans-serif; background: #f9fafb; color: #111827; }
.page { max-width: 1100px; margin: 0 auto; padding: 2rem 1rem; display: grid; gap: 1.5rem; }
</style>