<script setup>
defineProps({ vehicle: { type: Object, required: true } })

const formatPrice = (p) =>
    p == null ? 'Prix sur demande'
        : new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR', maximumFractionDigits: 0 }).format(p)
const formatKm = (km) => (km == null ? '-' : `${new Intl.NumberFormat('fr-FR').format(km)} km`)
</script>

<template>
  <article class="card">
    <img :src="vehicle.photo_url || '/placeholder.jpg'" :alt="`${vehicle.brand} ${vehicle.model}`" loading="lazy" />
    <div class="body">
      <h3>{{ vehicle.brand }} {{ vehicle.model }}</h3>
      <p class="version">{{ vehicle.version }}</p>
      <p class="meta">{{ formatKm(vehicle.mileage) }} · {{ vehicle.fuel || '-' }}</p>
      <p class="price">{{ formatPrice(vehicle.price) }}</p>
    </div>
  </article>
</template>

<style scoped>
.card { border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff; }
.card img { width: 100%; aspect-ratio: 16 / 10; object-fit: cover; background: #f3f4f6; }
.body { padding: 1rem; }
h3 { margin: 0; font-size: 1.1rem; }
.version, .meta { margin: .25rem 0; color: #6b7280; font-size: .9rem; }
.price { margin: .5rem 0 0; font-weight: 700; font-size: 1.2rem; }
</style>