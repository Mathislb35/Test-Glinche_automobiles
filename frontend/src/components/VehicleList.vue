<script setup>
import VehicleCard from './VehicleCard.vue'
defineProps({ vehicles: Array })
</script>

<template>
  <p v-if="!vehicles.length" class="empty">Aucun véhicule pour cette marque.</p>
  <div v-else class="grid">
    <VehicleCard v-for="v in vehicles" :key="v.id" :vehicle="v" />
  </div>
</template>

<style scoped>
.grid { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
.empty { color: #6b7280; }
</style>