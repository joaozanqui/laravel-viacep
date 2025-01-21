<template>
    <div>
      <span
        :class="[spinnerColor, spinnerStyle]"
        :style="{ width: size, height: size }"
        role="status"
      ></span>
      <span :class="[showSpinnerLabel]">{{ label }}</span>
    </div>
  </template>
  
  <script>
  const AVAILABLE_COLORS = [
    "primary",
    "secondary",
    "success",
    "danger",
    "warning",
    "info",
    "light",
    "dark",
  ];
  
  export default {
    props: {
      showLabel: {
        type: Boolean,
        default: false,
      },
      label: {
        type: String,
        default: "Carregando...",
      },
      color: {
        type: String,
        validator: function (value) {
          return AVAILABLE_COLORS.indexOf(value) !== -1;
        },
        default: "dark",
      },
      type: {
        type: String,
        validator: function (value) {
          return ["grow", "border"].indexOf(value) !== -1;
        },
        default: "border",
      },
      size: {
        type: String,
        default: "0.5rem",
      },
    },
    computed: {
      spinnerStyle() {
        return `spinner-${this.type}`;
      },
      spinnerColor() {
        return `text-${this.color}`;
      },
      showSpinnerLabel() {
        return !this.showLabel ? "d-none" : "";
      },
    },
  };
  </script>
  