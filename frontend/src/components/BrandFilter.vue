<script setup>
defineProps({ brands: Array, modelValue: String })
defineEmits(['update:modelValue'])
</script>

<template>
  <label class="filter">
    Marque
    <select :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
      <option value="">Toutes les marques</option>
      <option v-for="b in brands" :key="b" :value="b">{{ b }}</option>
    </select>
  </label>
</template>

<style scoped>
.filter { display: flex; flex-direction: column; gap: .25rem; font-weight: 600; max-width: 280px; }
select { padding: .6rem; border-radius: 8px; border: 1px solid #d1d5db; }
</style>