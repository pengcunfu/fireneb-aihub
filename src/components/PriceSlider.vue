<template>
  <div class="price-slider-container">
    <div class="price-slider" ref="sliderRef">
      <div class="slider-track"></div>
      <div class="slider-range" :style="{ left: minPercent + '%', width: maxPercent - minPercent + '%' }"></div>
      <div
        class="slider-thumb slider-thumb-min"
        :style="{ left: minPercent + '%' }"
        @mousedown="startDrag('min', $event)"
        @touchstart.prevent="startDrag('min', $event)"
      ></div>
      <div
        class="slider-thumb slider-thumb-max"
        :style="{ left: maxPercent + '%' }"
        @mousedown="startDrag('max', $event)"
        @touchstart.prevent="startDrag('max', $event)"
      ></div>
    </div>
    <div class="slider-values">
      <span class="slider-value">¥{{ Math.round(min) }}</span>
      <span class="slider-value">¥{{ Math.round(max) }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onUnmounted } from 'vue'

const props = defineProps({
  min: { type: Number, required: true },
  max: { type: Number, required: true },
  maxValue: { type: Number, required: true }
})

const emit = defineEmits(['update:min', 'update:max'])

const sliderRef = ref(null)
const isDragging = ref(null)

const minPercent = computed(() => (props.min / props.maxValue) * 100)
const maxPercent = computed(() => (props.max / props.maxValue) * 100)

const handleDrag = (e) => {
  if (!isDragging.value || !sliderRef.value) return

  const rect = sliderRef.value.getBoundingClientRect()
  const x = (e.clientX || e.touches?.[0]?.clientX) - rect.left
  let percent = (x / rect.width) * 100
  percent = Math.max(0, Math.min(100, percent))
  const value = (percent / 100) * props.maxValue

  if (isDragging.value === 'min') {
    emit('update:min', Math.min(value, props.max))
  } else {
    emit('update:max', Math.max(value, props.min))
  }
}

const startDrag = (type, e) => {
  isDragging.value = type
  document.addEventListener('mousemove', handleDrag)
  document.addEventListener('mouseup', stopDrag)
  document.addEventListener('touchmove', handleDrag, { passive: false })
  document.addEventListener('touchend', stopDrag)
}

const stopDrag = () => {
  isDragging.value = null
  document.removeEventListener('mousemove', handleDrag)
  document.removeEventListener('mouseup', stopDrag)
  document.removeEventListener('touchmove', handleDrag)
  document.removeEventListener('touchend', stopDrag)
}

onUnmounted(() => {
  stopDrag()
})
</script>

<style scoped>
.price-slider-container {
  padding: 8px 0;
}

.price-slider {
  position: relative;
  height: 24px;
  margin: 10px 0;
}

.slider-track {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 6px;
  background: #e2e8f0;
  border-radius: 4px;
  transform: translateY(-50%);
}

.slider-range {
  position: absolute;
  top: 50%;
  height: 6px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border-radius: 4px;
  transform: translateY(-50%);
  pointer-events: none;
}

.slider-thumb {
  position: absolute;
  top: 50%;
  width: 18px;
  height: 18px;
  background: white;
  border: 2px solid #6366f1;
  border-radius: 50%;
  transform: translate(-50%, -50%);
  cursor: grab;
  transition: transform 0.2s;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  z-index: 10;
}

.slider-thumb:hover {
  transform: translate(-50%, -50%) scale(1.1);
}

.slider-thumb:active {
  cursor: grabbing;
}

.slider-values {
  display: flex;
  justify-content: space-between;
  margin-top: 4px;
}

.slider-value {
  font-size: 13px;
  color: var(--text-secondary);
  font-weight: 500;
}
</style>
