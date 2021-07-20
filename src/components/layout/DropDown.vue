<template>
  <div class="dropdown">
    <slot name="button"></slot>
    <ul
      class="dropdown-menu dropdown-menu-end"
      style="z-index=99"
      aria-labelledby="dropdownMenuLink"
    >
      <slot></slot>
    </ul>
  </div>
</template>
<script>
export default {};
</script>
<style>
</style>