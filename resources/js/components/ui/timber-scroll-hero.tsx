"use client"

import React, { useEffect, useRef, useState } from "react"

export interface TimberScrollHeroProps {
  imageSrc?: string
  windowSrc?: string
  title?: string
  subtitle?: string
  scrollHint?: string
  brandMark?: string
  signature?: { name: string; url: string } | false
  scrubDistance?: number
  className?: string
  style?: React.CSSProperties
}

const DEFAULT_IMAGE = "/images/forest-warm.jpg"
const DEFAULT_WINDOW = "/images/window.png"
const DEFAULT_SIGNATURE = { name: "BBHub", url: "#" }
const SANS = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif"

const COL_BG = "#0d110e"
const COL_TEXT = "#fff4e8"

const TEXT_START = 0.55
const TEXT_END = 0.88

function clamp(v: number, min: number, max: number) {
  return Math.min(max, Math.max(min, v))
}

export default function TimberScrollHero({
  imageSrc = DEFAULT_IMAGE,
  windowSrc = DEFAULT_WINDOW,
  title = "Solid wood. Direct from source to production.",
  subtitle = "TEAK · MAHOGANY · SUNGKAI · SUSTAINABLE TIMBER SUPPLY",
  scrollHint = "SCROLL TO EXPLORE",
  brandMark = "BBHub",
  signature = DEFAULT_SIGNATURE,
  scrubDistance = 2400,
  className,
  style,
}: TimberScrollHeroProps) {
  const sectionRef = useRef<HTMLDivElement>(null)
  const imageRef = useRef<HTMLDivElement>(null)
  const fogRef = useRef<HTMLDivElement>(null)
  const windowRef = useRef<HTMLImageElement>(null)
  const sunRayRef = useRef<HTMLDivElement>(null)
  const titleRef = useRef<HTMLDivElement>(null)
  const hintRef = useRef<HTMLDivElement>(null)
  const brandRef = useRef<HTMLDivElement>(null)
  const progressBarRef = useRef<HTMLDivElement>(null)
  const [ready, setReady] = useState(false)

  useEffect(() => {
    const section = sectionRef.current
    if (!section) return

    setReady(true)

    const reduceMotion =
      typeof window !== "undefined" &&
      window.matchMedia?.("(prefers-reduced-motion: reduce)").matches

    let rafId = 0
    let targetProgress = 0
    let currentProgress = 0
    let hasStartedScrolling = false
    let locked = false
    let lockedScrollY = 0
    let touchStartY = 0

    function engageLock() {
      if (locked || typeof document === "undefined") return
      locked = true
      lockedScrollY = window.scrollY
      const b = document.body.style
      b.position = "fixed"
      b.top = `-${lockedScrollY}px`
      b.left = "0"
      b.right = "0"
      b.width = "100%"
    }

    function releaseLock() {
      if (!locked || typeof document === "undefined") return
      locked = false
      const y = lockedScrollY
      const b = document.body.style
      b.position = ""
      b.top = ""
      b.left = ""
      b.right = ""
      b.width = ""
      window.scrollTo(0, y)
    }

    engageLock()

    function addDelta(deltaY: number) {
      if (targetProgress >= 0.999 && deltaY > 0) {
        releaseLock()
        return false
      }
      if (targetProgress <= 0.001 && deltaY < 0 && window.scrollY <= 10) {
        return false
      }
      if (!locked && window.scrollY <= 10 && deltaY < 0) {
        engageLock()
      }

      const next = clamp(targetProgress + deltaY / scrubDistance, 0, 1)
      targetProgress = next
      if (targetProgress > 0.001) hasStartedScrolling = true

      if (targetProgress >= 0.999 && deltaY > 0) {
        releaseLock()
        return false
      }

      return true
    }

    const onWheel = (e: WheelEvent) => {
      if (locked) {
        const shouldPrevent = addDelta(e.deltaY)
        if (shouldPrevent) e.preventDefault()
      } else if (window.scrollY <= 5 && e.deltaY < 0) {
        engageLock()
        targetProgress = 0.98
        e.preventDefault()
      }
    }

    const onTouchStart = (e: TouchEvent) => {
      touchStartY = e.touches[0]?.clientY ?? 0
    }
    const onTouchMove = (e: TouchEvent) => {
      const y = e.touches[0]?.clientY ?? touchStartY
      const deltaY = touchStartY - y
      touchStartY = y

      if (locked) {
        const shouldPrevent = addDelta(deltaY)
        if (shouldPrevent) e.preventDefault()
      } else if (window.scrollY <= 5 && deltaY < 0) {
        engageLock()
        targetProgress = 0.98
        e.preventDefault()
      }
    }

    window.addEventListener("wheel", onWheel, { passive: false })
    window.addEventListener("touchstart", onTouchStart, { passive: true })
    window.addEventListener("touchmove", onTouchMove, { passive: false })

    function frame() {
      currentProgress += (targetProgress - currentProgress) * 0.18

      // 1. Forest background zoom & sun rays bloom as we pass through the window
      if (imageRef.current) {
        const zoomT = clamp(currentProgress / 0.78, 0, 1)
        const scale = 1 + zoomT * 0.45
        if (currentProgress >= 0.78) {
          imageRef.current.style.transform = `scale(${scale})`
          imageRef.current.style.filter = "none"
        } else {
          const blurAmount = (1 - zoomT) * 1.5
          const brightness = 0.88 + zoomT * 0.12
          const contrast = 0.92 + zoomT * 0.08
          imageRef.current.style.transform = `scale(${scale})`
          imageRef.current.style.filter = `blur(${blurAmount}px) brightness(${brightness}) contrast(${contrast})`
        }
      }

      if (sunRayRef.current) {
        const zoomT = clamp(currentProgress / 0.78, 0, 1)
        sunRayRef.current.style.opacity = String(zoomT * 0.9)
        sunRayRef.current.style.transform = `scale(${0.9 + zoomT * 0.25})`
      }

      if (fogRef.current) {
        const zoomT = clamp(currentProgress / 0.78, 0, 1)
        fogRef.current.style.opacity = String(clamp(1 - zoomT * 1.2, 0, 1))
      }

      // 2. Window overlay zoom out and fade out (passing through it)
      if (windowRef.current) {
        const frameT = clamp(currentProgress / 0.78, 0, 1)
        const scale = 1 + frameT * 0.95
        const opacity = clamp(1 - frameT * 1.3, 0, 1)
        const blur = frameT * 16
        windowRef.current.style.transform = `scale(${scale})`
        windowRef.current.style.opacity = String(opacity)
        windowRef.current.style.filter = `blur(${blur}px)`
      }

      // 3. Title fade & blur
      if (titleRef.current) {
        const t = 1 - clamp(currentProgress / 0.35, 0, 1)
        titleRef.current.style.opacity = String(t)
        titleRef.current.style.transform = `translateY(${(1 - t) * -30}px) scale(${0.95 + t * 0.05})`
        titleRef.current.style.filter = `blur(${(1 - t) * 12}px)`
      }

      // 4. Hint fade
      if (hintRef.current) {
        hintRef.current.style.opacity = hasStartedScrolling ? "0" : "1"
      }

      // 5. Brand mark reveal
      if (brandRef.current) {
        const t = clamp((currentProgress - TEXT_START) / (TEXT_END - TEXT_START), 0, 1)
        brandRef.current.style.opacity = String(t)
        brandRef.current.style.transform = `translateY(${(1 - t) * 24}px) scale(${0.96 + t * 0.04})`
        brandRef.current.style.filter = `blur(${(1 - t) * 8}px)`
        brandRef.current.style.letterSpacing = `${(1 - t) * 0.18}em`
      }

      // 6. Progress bar
      if (progressBarRef.current) {
        progressBarRef.current.style.transform = `scaleX(${currentProgress})`
      }

      rafId = requestAnimationFrame(frame)
    }

    if (!reduceMotion) {
      rafId = requestAnimationFrame(frame)
    }

    return () => {
      window.removeEventListener("wheel", onWheel)
      window.removeEventListener("touchstart", onTouchStart)
      window.removeEventListener("touchmove", onTouchMove)
      cancelAnimationFrame(rafId)
      releaseLock()
    }
  }, [scrubDistance])

  return (
    <div
      ref={sectionRef}
      className={className}
      style={{
        position: "relative",
        height: "100vh",
        minHeight: "680px",
        width: "100%",
        overflow: "hidden",
        background: COL_BG,
        ...style,
      }}
    >
      {/* Layer 1: Forest Image (Behind Window) */}
      <div
        ref={imageRef}
        style={{
          position: "absolute",
          inset: 0,
          width: "100%",
          height: "100%",
          backgroundImage: `url('${imageSrc}')`,
          backgroundSize: "cover",
          backgroundPosition: "center center",
          transformOrigin: "center center",
          filter: "blur(2px) brightness(0.85) contrast(0.9)",
          willChange: "transform, filter",
        }}
      />

      {/* Fog/Mist Layer */}
      <div
        ref={fogRef}
        style={{
          position: "absolute",
          inset: 0,
          background:
            "radial-gradient(ellipse at 50% 60%, rgba(220, 230, 230, 0.45) 0%, rgba(200, 215, 215, 0.25) 45%, rgba(18, 23, 17, 0.3) 80%)",
          mixBlendMode: "screen",
          opacity: 1,
          pointerEvents: "none",
          zIndex: 1,
          willChange: "opacity",
        }}
      />

      {/* Sunlight Rays Bloom Effect */}
      <div
        ref={sunRayRef}
        style={{
          position: "absolute",
          inset: 0,
          background:
            "radial-gradient(circle at 60% 30%, rgba(255,235,180,0.85) 0%, rgba(245,170,90,0.4) 40%, transparent 75%)",
          opacity: 0,
          mixBlendMode: "screen",
          pointerEvents: "none",
          zIndex: 2,
          willChange: "opacity, transform",
        }}
      />

      {/* Atmospheric Vignette */}
      <div
        style={{
          position: "absolute",
          inset: 0,
          background:
            "linear-gradient(180deg, rgba(13,17,14,0.15) 0%, rgba(13,17,14,0) 40%, rgba(13,17,14,0.3) 100%)",
          pointerEvents: "none",
          zIndex: 2,
        }}
      />

      {/* Layer 2: Window Image Overlay (downloads/window.png) */}
      <img
        ref={windowRef}
        src={windowSrc}
        alt="Window frame"
        style={{
          position: "absolute",
          inset: 0,
          width: "100%",
          height: "100%",
          objectFit: "cover",
          pointerEvents: "none",
          zIndex: 3,
          willChange: "transform, opacity, filter",
        }}
      />

      {/* Layer 3: Brand mark that emerges through scroll */}
      <div
        ref={brandRef}
        style={{
          position: "absolute",
          inset: 0,
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
          justifyContent: "center",
          padding: "0 8% 8vh",
          textAlign: "center",
          opacity: 0,
          pointerEvents: "none",
          zIndex: 4,
        }}
      >
        <span
          style={{
            fontFamily: SANS,
            fontWeight: 800,
            fontSize: "clamp(72px, 18vw, 240px)",
            lineHeight: 1,
            letterSpacing: "-0.03em",
            color: COL_TEXT,
            mixBlendMode: "overlay",
            opacity: 0.85,
            textShadow: "0 4px 30px rgba(0,0,0,0.5)",
          }}
        >
          {brandMark}
        </span>
        <span
          style={{
            fontFamily: SANS,
            fontWeight: 600,
            fontSize: "clamp(12px, 1.6vw, 15px)",
            letterSpacing: "0.25em",
            color: "#e8cba2",
            marginTop: "16px",
            textTransform: "uppercase",
            mixBlendMode: "overlay",
            opacity: 0.9,
          }}
        >
          Timber supply, connected.
        </span>
      </div>

      {/* Initial Hero Title */}
      <div
        ref={titleRef}
        style={{
          position: "absolute",
          inset: 0,
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
          justifyContent: "center",
          padding: "0 12%",
          textAlign: "center",
          pointerEvents: "none",
          zIndex: 5,
        }}
      >
        <span
          style={{
            fontFamily: SANS,
            fontWeight: 600,
            fontSize: "clamp(11px, 1.4vw, 13px)",
            letterSpacing: "0.28em",
            color: "#e8cba2",
            marginBottom: "18px",
            textTransform: "uppercase",
            textShadow: "0 2px 14px rgba(0,0,0,0.8)",
          }}
        >
          {subtitle}
        </span>
        <h1
          style={{
            fontFamily: SANS,
            fontWeight: 700,
            fontSize: "clamp(34px, 5.8vw, 72px)",
            lineHeight: 1.15,
            letterSpacing: "-0.02em",
            color: COL_TEXT,
            maxWidth: "960px",
            margin: 0,
            textShadow: "0 6px 36px rgba(0,0,0,0.8)",
          }}
        >
          {title}
        </h1>
      </div>

      {/* Scroll Hint indicator */}
      <div
        ref={hintRef}
        style={{
          position: "absolute",
          left: "50%",
          bottom: "clamp(24px, 6vh, 48px)",
          transform: "translateX(-50%)",
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
          gap: 8,
          color: "rgba(255,244,232,0.85)",
          fontFamily: SANS,
          fontSize: "clamp(10px, 1.4vw, 12px)",
          fontWeight: 600,
          letterSpacing: "0.3em",
          transition: "opacity 0.4s ease",
          pointerEvents: "none",
          zIndex: 6,
        }}
      >
        <span>{scrollHint}</span>
        <svg width="14" height="18" viewBox="0 0 14 18" style={{ animation: "forest-bounce 1.6s ease-in-out infinite" }}>
          <style>{`
            @keyframes forest-bounce {
              0%, 100% { transform: translateY(0); opacity: 0.5; }
              50% { transform: translateY(5px); opacity: 1; }
            }
          `}</style>
          <path d="M7 1 L7 17 M2 12 L7 17 L12 12" stroke="currentColor" strokeWidth="1.5" fill="none" strokeLinecap="round" strokeLinejoin="round" />
        </svg>
      </div>

      {/* Bottom Progress Bar */}
      <div
        style={{
          position: "absolute",
          left: 0,
          right: 0,
          bottom: 0,
          height: 3,
          background: "rgba(255,244,232,0.15)",
          zIndex: 6,
        }}
      >
        <div
          ref={progressBarRef}
          style={{
            height: "100%",
            width: "100%",
            background: "linear-gradient(90deg, #a38355, #f5ebd9)",
            transform: "scaleX(0)",
            transformOrigin: "left center",
          }}
        />
      </div>

      {/* Watermark/Signature */}
      {signature && (
        <span
          style={{
            position: "absolute",
            right: "clamp(14px, 2.5vw, 28px)",
            bottom: "clamp(12px, 2vw, 18px)",
            fontFamily: SANS,
            fontWeight: 500,
            fontSize: "clamp(11px, 1.4vw, 13px)",
            letterSpacing: "0.01em",
            color: "rgba(255,244,232,0.6)",
            zIndex: 6,
          }}
        >
          by{" "}
          <a
            href={signature.url}
            style={{
              color: "rgba(255,244,232,0.8)",
              textDecoration: "none",
              transition: "color 0.2s ease",
            }}
          >
            {signature.name}
          </a>
        </span>
      )}
    </div>
  )
}
