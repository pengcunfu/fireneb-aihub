<template>
  <div class="checkbox-group">
    <label class="checkbox-item" v-for="item in items" :key="item">
      <input type="checkbox" :value="item" v-model="selected">
      <span>{{ item }}</span>
    </label>
  </div>
</template>

<script setup>
const props = defineProps({
  items: Array
})

const selected = defineModel()
</script>

<style scoped>
.checkbox-group {
  display: flex;
  flex-direction: column;
  gap: 4px;
  max-height: 240px;
  overflow-y: auto;
}

.checkbox-item {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  padding: 8px 12px;
  border-radius: var(--radius-md);
  transition: background 0.15s;
}

.checkbox-item:hover {
  background: var(--bg-tertiary);
}

.checkbox-item input[type="checkbox"] {
  appearance: none;
  width: 18px;
  height: 18px;
  border: 2px solid var(--border-color);
  border-radius: 5px;
  background: white;
  cursor: pointer;
  position: relative;
  transition: all 0.2s;
  flex-shrink: 0;
}

.checkbox-item input[type="checkbox"]:checked {
  background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
  border-color: transparent;
}

.checkbox-item input[type="checkbox"]:checked::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -60%) rotate(45deg);
  width: 6px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
}

.checkbox-item span {
  font-size: 13px;
  color: var(--text-primary);
  cursor: pointer;
  flex: 1;
  font-weight: 500;
}
</style>
