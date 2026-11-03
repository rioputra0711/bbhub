"use client"

import React, { useEffect, useRef, useState } from "react"
import { ChevronLeft, ChevronRight, Heart } from "lucide-react"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardFooter } from "@/components/ui/card"
import { cn } from "@/lib/utils"
import { locale, t } from "@/lib/i18n"

/** Row shape emitted by HomeController into `#bbhub-products`. */
export interface ProductRow {
  id: number
  code: string
  title: string
  image: string | null
  species: string | null
  location: string | null
  dimensions: string | null
  volume: number
  moisture_min: number | null
  moisture_max: number | null
  price: number | null
  grade: string | null
  custom: boolean
}

function readProducts(): ProductRow[] {
  if (typeof document === "undefined") return []

  const node = document.getElementById("bbhub-products")
  if (!node?.textContent) return []

  try {
    const parsed = JSON.parse(node.textContent)
    return Array.isArray(parsed) ? (parsed as ProductRow[]) : []
  } catch {
    return []
  }
}

const products = readProducts()

function trimNumber(value: number): string {
  return Number.isInteger(value) ? String(value) : String(Math.round(value * 100) / 100)
}

function formatVolume(value: number): string {
  return new Intl.NumberFormat(locale, {
    minimumFractionDigits: 1,
    maximumFractionDigits: 1,
  }).format(value)
}

function formatPrice(value: number): string {
  return new Intl.NumberFormat(locale, {
    maximumFractionDigits: 0,
  }).format(value)
}

function buildLocation(row: ProductRow): string | null {
  const parts = [row.location, row.dimensions].filter(
    (part): part is string => Boolean(part && part.trim()),
  )

  return parts.length ? parts.join(" · ") : null
}

function buildStock(row: ProductRow): string {
  const parts = [t("carousel.volume_available").replace(":volume", formatVolume(row.volume))]

  if (row.moisture_min !== null && row.moisture_max !== null) {
    parts.push(
      t("carousel.moisture").replace(
        ":range",
        t("carousel.moisture_range")
          .replace(":min", trimNumber(row.moisture_min))
          .replace(":max", trimNumber(row.moisture_max)),
      ),
    )
  }

  return parts.join(" · ")
}

const TimberCard = ({ row }: { row: ProductRow }) => {
  const [isFavorite, setIsFavorite] = useState(false)

  const location = buildLocation(row)
  const badge = row.custom ? t("carousel.custom_order") : row.grade

  return (
    <Card className="group relative flex h-[300px] sm:h-[330px] w-full flex-col overflow-hidden rounded-xl border border-[#e7e4dc] bg-white shadow-xs transition-shadow duration-300 hover:shadow-md">
      <div className="relative aspect-[4/3] w-full overflow-hidden rounded-t-xl bg-neutral-100">
        {row.image ? (
          <img
            alt={t("carousel.image_alt").replace(":title", row.title)}
            className="size-full object-cover transition-transform duration-300 group-hover:scale-105"
            src={row.image}
            loading="lazy"
            decoding="async"
          />
        ) : (
          <div className="flex size-full items-center justify-center bg-neutral-100 text-xs text-[#79766e]">
            {row.species ?? row.code}
          </div>
        )}
        <Button
          type="button"
          onClick={(e) => {
            e.preventDefault()
            e.stopPropagation()
            setIsFavorite((prev) => !prev)
          }}
          className="absolute top-2.5 right-2.5 z-10 h-7 w-7 rounded-full bg-white/85 text-neutral-700 backdrop-blur-sm transition-colors hover:bg-white hover:text-black"
          size="icon"
          variant="ghost"
        >
          <Heart
            className={`h-4 w-4 stroke-[2px] ${
              isFavorite ? "fill-rose-500 text-rose-500" : ""
            }`}
          />
          <span className="sr-only">{t("carousel.favorites")}</span>
        </Button>
        {badge && (
          <Badge className="absolute top-2.5 left-2.5 rounded-md border-0 bg-white/95 px-2 py-0.5 font-medium text-[#292821] text-xs shadow-xs">
            {badge}
          </Badge>
        )}
      </div>

      <div className="flex flex-1 flex-col justify-between p-3.5">
        <CardContent className="p-0 space-y-1">
          <h3 className="font-semibold text-sm tracking-tight text-[#292821] line-clamp-1">
            {row.title}
          </h3>
          {location && (
            <p className="text-[#79766e] text-xs tracking-tight line-clamp-1">{location}</p>
          )}
          <p className="text-[#52694e] font-medium text-xs tracking-tight">
            {buildStock(row)}
          </p>
        </CardContent>

        <CardFooter className="mt-auto flex items-center justify-between p-0 pt-2 border-t border-[#f0eee6]">
          <span className="text-[#79766e] text-[11px] tracking-tight">{row.code}</span>
          <span className="font-semibold text-xs text-[#292821] tracking-tight">
            {row.price !== null
              ? `Rp ${formatPrice(row.price)} ${t("carousel.per_m3")}`
              : t("carousel.custom_order")}
          </span>
        </CardFooter>
      </div>
    </Card>
  )
}

export default function ProductionCarousel({
  title = t("carousel.title"),
  categoryTag = t("carousel.tag"),
  items = products,
  viewAllHref = "#stock",
}: {
  title?: string
  categoryTag?: string
  items?: ProductRow[]
  viewAllHref?: string
}) {
  const scrollContainer = useRef<HTMLDivElement>(null)
  const [canScrollLeft, setCanScrollLeft] = useState(false)
  const [canScrollRight, setCanScrollRight] = useState(true)

  useEffect(() => {
    const el = scrollContainer.current
    if (!el) return

    const update = () => {
      setCanScrollLeft(el.scrollLeft > 4)
      setCanScrollRight(el.scrollLeft + el.clientWidth < el.scrollWidth - 4)
    }
    update()
    el.addEventListener("scroll", update, { passive: true })
    window.addEventListener("resize", update)
    return () => {
      el.removeEventListener("scroll", update)
      window.removeEventListener("resize", update)
    }
  }, [])

  const handleScrollLeft = () => {
    if (scrollContainer.current) {
      scrollContainer.current.scrollBy({
        left: -320,
        behavior: "smooth",
      })
    }
  }

  const handleScrollRight = () => {
    if (scrollContainer.current) {
      scrollContainer.current.scrollBy({ left: 320, behavior: "smooth" })
    }
  }

  return (
    <div className="w-full">
      <div className="mx-auto mb-6 flex w-full max-w-[1280px] flex-col md:flex-row md:items-end justify-between gap-4 px-5 sm:px-8 lg:px-12">
        <div className="flex flex-col gap-2 items-start">
          <span className="font-semibold leading-normal text-[#a38355] text-[12px] tracking-wider uppercase">
            {categoryTag}
          </span>
          <h2 className="font-medium leading-tight text-[#292821] text-2xl md:text-[36px] tracking-tight">
            {title}
          </h2>
        </div>

        <a
          className="self-start md:self-auto border border-[#e7e4dc] bg-white hover:bg-neutral-100 flex gap-2 h-9 items-center justify-center px-4 rounded-full text-[#292821] font-medium text-xs transition-colors"
          href={viewAllHref}
        >
          <span>{t("carousel.view_all")}</span>
          <ChevronRight className="h-3.5 w-3.5" />
        </a>
      </div>

      <div className="relative mx-auto flex w-full max-w-[1280px] items-center px-5 sm:px-8 lg:px-12">
        <Button
          type="button"
          className={cn(
            "absolute top-1/2 left-0 z-10 hidden h-9 w-9 -translate-y-1/2 rounded-full border border-[#e7e4dc] bg-white hover:bg-neutral-100 text-[#292821] shadow-xs transition-opacity duration-200 sm:flex sm:-left-2 lg:-left-3",
            !canScrollLeft && "invisible pointer-events-none",
          )}
          tabIndex={canScrollLeft ? 0 : -1}
          onClick={handleScrollLeft}
          size="icon"
          variant="outline"
        >
          <ChevronLeft className="h-4 w-4" />
          <span className="sr-only">{t("carousel.scroll_left")}</span>
        </Button>

        <div
          className="flex w-full min-w-0 snap-x snap-mandatory gap-5 overflow-x-auto pb-4 pt-1"
          ref={scrollContainer}
          style={{
            scrollbarWidth: "none",
            msOverflowStyle: "none",
          }}
        >
          <div className="mx-auto flex flex-none gap-5">
            {items.map((item) => (
              <div
                className="w-[220px] flex-none snap-start sm:w-[260px] md:w-[280px]"
                key={item.id}
              >
                <a
                  className="block rounded-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-400 focus-visible:ring-offset-2"
                  href={`#stock-${item.id}`}
                >
                  <TimberCard row={item} />
                </a>
              </div>
            ))}
            {items.length === 0 && (
              <p className="py-10 text-sm text-[#79766e]">{t("carousel.empty")}</p>
            )}
          </div>
        </div>

        <Button
          type="button"
          className={cn(
            "absolute top-1/2 right-0 z-10 hidden h-9 w-9 -translate-y-1/2 rounded-full border border-[#e7e4dc] bg-white hover:bg-neutral-100 text-[#292821] shadow-xs transition-opacity duration-200 sm:flex sm:-right-2 lg:-right-3",
            !canScrollRight && "invisible pointer-events-none",
          )}
          tabIndex={canScrollRight ? 0 : -1}
          onClick={handleScrollRight}
          size="icon"
          variant="outline"
        >
          <ChevronRight className="h-4 w-4" />
          <span className="sr-only">{t("carousel.scroll_right")}</span>
        </Button>
      </div>
    </div>
  )
}
