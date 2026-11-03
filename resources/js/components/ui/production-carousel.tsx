"use client"

import React, { useEffect, useRef, useState } from "react"
import { ChevronLeft, ChevronRight, Heart, Star } from "lucide-react"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardFooter } from "@/components/ui/card"
import { cn } from "@/lib/utils"

export interface TimberStockItem {
  id: string
  title: string
  image: string
  location: string
  spec?: string
  stockAvailable?: string
  price: string
  rating?: number
  reviewCount?: number
  badge?: string
}

const sampleTimberStock: TimberStockItem[] = [
  {
    id: "stock-1",
    title: "Teak Kiln Dried Boards",
    image: "/images/serat/stock-teak-kd.png",
    location: "Jepara, Central Java · 25 × 150 mm",
    stockAvailable: "24.8 m³ available · MC 10–12%",
    price: "Rp 18.500.000 / m³",
    rating: 4.98,
    reviewCount: 142,
    badge: "Ready Stock",
  },
  {
    id: "stock-2",
    title: "Mahogany Sawn Timber",
    image: "/images/serat/stock-mahoni.png",
    location: "Semarang, Central Java · 30 × 200 mm",
    stockAvailable: "36.0 m³ available · MC 12–15%",
    price: "Rp 8.500.000 / m³",
    rating: 4.95,
    reviewCount: 88,
    badge: "Best Seller",
  },
  {
    id: "stock-3",
    title: "Sungkai S4S Planed",
    image: "/images/serat/stock-sungkai.png",
    location: "Blora, Central Java · 25 × 150 mm",
    stockAvailable: "18.5 m³ available · MC 10–12%",
    price: "Rp 9.800.000 / m³",
    rating: 4.97,
    reviewCount: 64,
    badge: "Grade A",
  },
  {
    id: "stock-4",
    title: "Merbau Heavy Decking",
    image: "/images/timber-planks.jpg",
    location: "Papua, Indonesia · 20 × 140 mm",
    stockAvailable: "42.0 m³ available · Kiln Dried",
    price: "Rp 16.200.000 / m³",
    rating: 4.99,
    reviewCount: 110,
    badge: "Export Grade",
  },
  {
    id: "stock-5",
    title: "Teak Round Log Selection",
    image: "/images/timber-logs.jpg",
    location: "Cepu, Central Java · Dia 40+ cm",
    stockAvailable: "55.4 m³ available · Perhutani",
    price: "Rp 22.000.000 / m³",
    rating: 4.96,
    reviewCount: 76,
    badge: "FSC Certified",
  },
  {
    id: "stock-6",
    title: "Bengkirai Exterior Slats",
    image: "/images/serat/cat-solid-wood.png",
    location: "Kalimantan, Indonesia · 19 × 90 mm",
    stockAvailable: "30.2 m³ available · Air Dried",
    price: "Rp 11.500.000 / m³",
    rating: 4.92,
    reviewCount: 53,
    badge: "Weatherproof",
  },
  {
    id: "stock-7",
    title: "Pine Kiln Dried Slats",
    image: "/images/serat/cat-processed-wood.png",
    location: "North Sumatra · 18 × 120 mm",
    stockAvailable: "60.0 m³ available · MC 8–10%",
    price: "Rp 6.200.000 / m³",
    rating: 4.89,
    reviewCount: 41,
    badge: "Sustainable",
  },
]

const TimberCard = ({ item }: { item: TimberStockItem }) => {
  const [isFavorite, setIsFavorite] = useState(false)

  return (
    <Card className="group relative flex h-[300px] sm:h-[330px] w-full flex-col overflow-hidden rounded-xl border border-[#e7e4dc] bg-white shadow-xs transition-shadow duration-300 hover:shadow-md">
      <div className="relative aspect-[4/3] w-full overflow-hidden rounded-t-xl bg-neutral-100">
        <img
          alt={item.title}
          className="size-full object-cover transition-transform duration-300 group-hover:scale-105"
          src={item.image}
          loading="lazy"
          decoding="async"
        />
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
          <span className="sr-only">Add to favorites</span>
        </Button>
        {item.badge && (
          <Badge className="absolute top-2.5 left-2.5 rounded-md border-0 bg-white/95 px-2 py-0.5 font-medium text-[#292821] text-xs shadow-xs">
            {item.badge}
          </Badge>
        )}
      </div>

      <div className="flex flex-1 flex-col justify-between p-3.5">
        <CardContent className="p-0 space-y-1">
          <h3 className="font-semibold text-sm tracking-tight text-[#292821] line-clamp-1">
            {item.title}
          </h3>
          <p className="text-[#79766e] text-xs tracking-tight line-clamp-1">
            {item.location}
          </p>
          {item.stockAvailable && (
            <p className="text-[#52694e] font-medium text-xs tracking-tight">
              {item.stockAvailable}
            </p>
          )}
        </CardContent>

        <CardFooter className="mt-auto flex items-center justify-between p-0 pt-2 border-t border-[#f0eee6]">
          <div className="flex items-center gap-1 text-xs">
            {item.rating && (
              <span className="flex items-center gap-0.5 font-medium text-[#292821]">
                <Star className="h-3 w-3 fill-amber-400 text-amber-400" />
                {item.rating}
              </span>
            )}
            {item.reviewCount && (
              <span className="text-[#79766e] text-xs tracking-tight">
                · ({item.reviewCount})
              </span>
            )}
          </div>
          <span className="font-semibold text-xs text-[#292821] tracking-tight">
            {item.price}
          </span>
        </CardFooter>
      </div>
    </Card>
  )
}

export default function ProductionCarousel({
  title = "Selected material, ready to order.",
  categoryTag = "AVAILABLE FOR PRODUCTION",
  items = sampleTimberStock,
  viewAllHref = "#stock",
}: {
  title?: string
  categoryTag?: string
  items?: TimberStockItem[]
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
          <span>View all stock</span>
          <ChevronRight className="h-3.5 w-3.5" />
        </a>
      </div>

      <div className="mx-auto flex w-full max-w-[1280px] items-center gap-3 px-5 sm:px-8 lg:px-12">
        <Button
          type="button"
          className={cn(
            "hidden sm:flex h-9 w-9 shrink-0 rounded-full border border-[#e7e4dc] bg-white hover:bg-neutral-100 text-[#292821] shadow-xs transition-opacity duration-200",
            !canScrollLeft && "invisible pointer-events-none",
          )}
          tabIndex={canScrollLeft ? 0 : -1}
          onClick={handleScrollLeft}
          size="icon"
          variant="outline"
        >
          <ChevronLeft className="h-4 w-4" />
          <span className="sr-only">Scroll left</span>
        </Button>

        <div
          className="flex min-w-0 flex-1 snap-x snap-mandatory gap-5 overflow-x-auto pb-4 pt-1"
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
                  <TimberCard item={item} />
                </a>
              </div>
            ))}
          </div>
        </div>

        <Button
          type="button"
          className={cn(
            "hidden sm:flex h-9 w-9 shrink-0 rounded-full border border-[#e7e4dc] bg-white hover:bg-neutral-100 text-[#292821] shadow-xs transition-opacity duration-200",
            !canScrollRight && "invisible pointer-events-none",
          )}
          tabIndex={canScrollRight ? 0 : -1}
          onClick={handleScrollRight}
          size="icon"
          variant="outline"
        >
          <ChevronRight className="h-4 w-4" />
          <span className="sr-only">Scroll right</span>
        </Button>
      </div>
    </div>
  )
}
