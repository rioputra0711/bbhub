import React from "react"
import { createRoot } from "react-dom/client"
import ProductionCarousel from "./components/ui/production-carousel"

const container = document.getElementById("production-carousel-root")
if (container) {
  const root = createRoot(container)
  root.render(<ProductionCarousel />)
}
