"use client"

import React, { useEffect, useState } from "react"
import { motion } from "framer-motion"
import { Check, ChevronDown, LucideIcon } from "lucide-react"
import { cn } from "@/lib/utils"

interface NavItem {
  name: string
  url: string
  icon?: LucideIcon
  badge?: number
  hideLabel?: boolean
}

interface NavBarProps {
  items: NavItem[]
  actions?: NavItem[]
  languages?: string[]
  defaultActive?: string
  onLanguageChange?: (code: string) => void
  className?: string
}

const FLAGS: Record<string, React.ReactNode> = {
  ID: (
    <svg viewBox="0 0 24 16" className="h-[12px] w-[18px] shrink-0 rounded-[2px]" aria-hidden="true">
      <rect width="24" height="8" fill="#CE1126" />
      <rect y="8" width="24" height="8" fill="#FFFFFF" />
    </svg>
  ),
  EN: (
    <svg viewBox="0 0 24 16" className="h-[12px] w-[18px] shrink-0 rounded-[2px]" aria-hidden="true">
      <rect width="24" height="16" fill="#FFFFFF" />
      {[0, 2, 4, 6, 8, 10, 12].map((y) => (
        <rect key={y} y={y * (16 / 13)} width="24" height={16 / 13} fill="#B22234" />
      ))}
      <rect width="10" height={16 * (7 / 13)} fill="#3C3B6E" />
      {[0, 1, 2, 3].map((row) =>
        [0, 1, 2, 3, 4].map((col) => (
          <circle
            key={`${row}-${col}`}
            cx={1.4 + col * 1.9}
            cy={1.3 + row * 1.9}
            r="0.55"
            fill="#FFFFFF"
          />
        )),
      )}
    </svg>
  ),
}

export function NavBar({ items, actions, languages, defaultActive, onLanguageChange, className }: NavBarProps) {
  const [activeTab, setActiveTab] = useState(defaultActive ?? items[0].name)
  const [hidden, setHidden] = useState(false)
  const [lang, setLang] = useState(languages?.[0] ?? "EN")
  const [langOpen, setLangOpen] = useState(false)
  const langOpenRef = React.useRef(false)

  React.useEffect(() => {
    langOpenRef.current = langOpen
  }, [langOpen])

  const handleLang = (code: string) => {
    setLang(code)
    onLanguageChange?.(code)
  }

  const langRef = React.useRef<HTMLDivElement>(null)

  React.useEffect(() => {
    if (!langOpen) return
    const onClick = (e: MouseEvent) => {
      if (!langRef.current?.contains(e.target as Node)) setLangOpen(false)
    }
    const onKey = (e: KeyboardEvent) => {
      if (e.key === "Escape") setLangOpen(false)
    }
    document.addEventListener("mousedown", onClick)
    document.addEventListener("keydown", onKey)
    return () => {
      document.removeEventListener("mousedown", onClick)
      document.removeEventListener("keydown", onKey)
    }
  }, [langOpen])

  // Visible while scrolling, hides after the user stops scrolling. Stays visible at the top of the page.
  useEffect(() => {
    let idle: number | undefined

    if (window.scrollY <= 120) setHidden(false)

    const onScroll = () => {
      setHidden(false)
      window.clearTimeout(idle)
      idle = window.setTimeout(() => {
        if (window.scrollY > 120 && !langOpenRef.current) setHidden(true)
      }, 1400)
    }

    window.addEventListener("scroll", onScroll, { passive: true })
    return () => {
      window.removeEventListener("scroll", onScroll)
      window.clearTimeout(idle)
    }
  }, [])

  // Keep the navbar visible while the language dropdown is open.
  useEffect(() => {
    if (langOpen) setHidden(false)
  }, [langOpen])

  return (
    <div
      className={cn(
        "fixed top-0 inset-x-0 z-50 flex justify-center pt-4 sm:pt-6 transition-transform duration-700 ease-in-out",
        hidden && "pointer-events-none",
        className,
      )}
      style={{
        transform: `translateY(${hidden ? "-140%" : "0"})`,
      }}
    >
      <div className="relative flex w-full items-center justify-center px-3 sm:px-6">
        <div className="relative">
          {languages && languages.length > 0 && (
            <div ref={langRef} className="absolute right-full top-1/2 mr-3 hidden -translate-y-1/2 sm:mr-4 sm:block">
              <button
                type="button"
                onClick={() => setLangOpen((o) => !o)}
                aria-haspopup="listbox"
                aria-expanded={langOpen}
                className="flex cursor-pointer items-center gap-1.5 whitespace-nowrap text-sm font-semibold text-white/85 transition-colors hover:text-white"
              >
                {FLAGS[lang]}
                <span>{lang}</span>
                <ChevronDown
                  size={14}
                  strokeWidth={2.5}
                  className={cn("transition-transform duration-200", langOpen && "rotate-180")}
                />
              </button>

              {langOpen && (
                <ul
                  role="listbox"
                  className="absolute right-0 top-full z-50 mt-2 min-w-[96px] overflow-hidden rounded-xl border border-white/25 bg-[#3d3227]/95 py-1 text-sm font-semibold text-white shadow-xl backdrop-blur-lg"
                >
                  {languages.map((code) => (
                    <li key={code}>
                      <button
                        type="button"
                        role="option"
                        aria-selected={code === lang}
                        onClick={() => {
                          handleLang(code)
                          setLangOpen(false)
                        }}
                        className={cn(
                          "flex w-full cursor-pointer items-center justify-between px-3 py-1.5 transition-colors hover:bg-white/15",
                          code === lang ? "text-white" : "text-white/70",
                        )}
                      >
                        <span className="flex items-center gap-2">
                          {FLAGS[code]}
                          {code}
                        </span>
                        {code === lang && <Check size={13} strokeWidth={3} />}
                      </button>
                    </li>
                  ))}
                </ul>
              )}
            </div>
          )}
          <div className="flex items-center gap-0.5 sm:gap-3 bg-[#a38355]/40 border border-white/30 backdrop-blur-lg py-1 px-1 rounded-full shadow-lg text-white">
          {items.map((item) => {
            const Icon = item.icon
            const isActive = activeTab === item.name

            return (
              <a
                key={item.name}
                href={item.url}
                onClick={() => setActiveTab(item.name)}
                className={cn(
                  "relative cursor-pointer text-sm font-semibold px-2.5 sm:px-6 py-2 rounded-full transition-colors",
                  "text-white/90 hover:text-white",
                  isActive && "bg-white/20 text-white shadow-sm",
                )}
              >
                <span className="hidden md:inline">{item.name}</span>
                <span className="md:hidden">
                  {Icon && <Icon size={18} strokeWidth={2.5} />}
                </span>
                {isActive && (
                  <motion.div
                    layoutId="lamp"
                    className="absolute inset-0 w-full bg-[#a38355]/10 rounded-full -z-10"
                    initial={false}
                    transition={{
                      type: "spring",
                      stiffness: 300,
                      damping: 30,
                    }}
                  >
                    <div className="absolute -top-2 left-1/2 -translate-x-1/2 w-8 h-1 bg-[#a38355] rounded-t-full">
                      <div className="absolute w-12 h-6 bg-[#a38355]/20 rounded-full blur-md -top-2 -left-2" />
                      <div className="absolute w-8 h-6 bg-[#a38355]/20 rounded-full blur-md -top-1" />
                      <div className="absolute w-4 h-4 bg-[#a38355]/20 rounded-full blur-sm top-0 left-2" />
                    </div>
                  </motion.div>
                )}
              </a>
            )
          })}
        </div>

          {actions && actions.length > 0 && (
            <div className="absolute left-full top-1/2 ml-2 flex -translate-y-1/2 items-center gap-3 whitespace-nowrap text-white sm:ml-4 sm:gap-4">
              {actions.map((action) => {
                const Icon = action.icon
                return (
                  <a
                    key={action.name}
                    href={action.url}
                    className={cn(
                      "relative flex items-center gap-2 cursor-pointer text-sm font-semibold transition-colors",
                      "text-white/85 hover:text-white",
                    )}
                  >
                    {Icon && <Icon size={18} strokeWidth={2.5} />}
                    {!action.hideLabel && (
                      <span className={Icon ? "hidden sm:inline" : "inline"}>{action.name}</span>
                    )}
                    {typeof action.badge === "number" && action.badge > 0 && (
                      <span className="flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-white px-1 text-[10px] font-bold text-[#292821]">
                        {action.badge}
                      </span>
                    )}
                  </a>
                )
              })}
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
