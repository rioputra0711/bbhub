"use client"

import React, { useEffect, useRef, useState } from "react"

export interface TimberScrollHeroProps {
  imageSrc?: string
  windowSrc?: string
  title?: string
  scrollHint?: string
  brandMark?: string
  signature?: { name: string; url: string } | false
  className?: string
  style?: React.CSSProperties
}

const DEFAULT_IMAGE = "/images/forest-warm.jpg"
const DEFAULT_WINDOW = "/images/window.png"
const DEFAULT_SIGNATURE = { name: "BBHub", url: "#" }
const SANS = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif"

const COL_BG = "#0d110e"
const COL_TEXT = "#fff4e8"

const TEXT_START = 0.52
const TEXT_END = 0.88

function clamp(v: number, min: number, max: number) {
  return Math.min(max, Math.max(min, v))
}

export default function TimberScrollHero({
  imageSrc = DEFAULT_IMAGE,
  windowSrc = DEFAULT_WINDOW,
  title = "Solid wood. Direct from source to production.",
  scrollHint = "SCROLL TO EXPLORE",
  brandMark = "BBHub",
  signature = DEFAULT_SIGNATURE,
  className,
  style,
}: TimberScrollHeroProps) {
  const containerRef = useRef<HTMLDivElement>(null)
  const imageRef = useRef<HTMLDivElement>(null)
  const fogRef = useRef<HTMLDivElement>(null)
  const windowRef = useRef<HTMLImageElement>(null)
  const sunRayRef = useRef<HTMLDivElement>(null)
  const titleRef = useRef<HTMLDivElement>(null)
  const hintRef = useRef<HTMLDivElement>(null)
  const brandRef = useRef<HTMLDivElement>(null)
  const progressBarRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    const container = containerRef.current
    if (!container) return

    let rafId = 0
    let latestProgress = 0

    const updateVisuals = (progress: number) => {
      // 1. Forest zoom & sun rays bloom
      if (imageRef.current) {
        const zoomT = clamp(progress / 0.78, 0, 1)
        const scale = 1 + zoomT * 0.45
        imageRef.current.style.transform = `scale3d(${scale}, ${scale}, 1)`
      }

      if (sunRayRef.current) {
        const zoomT = clamp(progress / 0.78, 0, 1)
        sunRayRef.current.style.opacity = String(zoomT * 0.9)
        const rayScale = 0.9 + zoomT * 0.25
        sunRayRef.current.style.transform = `scale3d(${rayScale}, ${rayScale}, 1)`
      }

      if (fogRef.current) {
        const zoomT = clamp(progress / 0.78, 0, 1)
        fogRef.current.style.opacity = String(clamp(1 - zoomT * 1.3, 0, 1))
      }

      // 2. Window frame overlay zoom-through & fade
      if (windowRef.current) {
        const frameT = clamp(progress / 0.78, 0, 1)
        const scale = 1 + frameT * 0.95
        const opacity = clamp(1 - frameT * 1.3, 0, 1)
        windowRef.current.style.transform = `scale3d(${scale}, ${scale}, 1)`
        windowRef.current.style.opacity = String(opacity)
      }

      // 3. Title fade out early
      if (titleRef.current) {
        const t = 1 - clamp(progress / 0.35, 0, 1)
        titleRef.current.style.opacity = String(t)
        titleRef.current.style.transform = `translate3d(0, ${(1 - t) * -25}px, 0)`
      }

      // 4. Scroll hint indicator fade
      if (hintRef.current) {
        hintRef.current.style.opacity = progress > 0.04 ? "0" : "1"
        hintRef.current.style.display = progress > 0.15 ? "none" : "flex"
      }

      // 5. Brand mark reveal
      if (brandRef.current) {
        const t = clamp((progress - TEXT_START) / (TEXT_END - TEXT_START), 0, 1)
        brandRef.current.style.opacity = String(t)
        brandRef.current.style.transform = `translate3d(0, ${(1 - t) * 20}px, 0)`
      }

      // 6. Progress bar
      if (progressBarRef.current) {
        progressBarRef.current.style.transform = `scaleX(${progress})`
      }
    }

    const onScroll = () => {
      if (!container) return
      const rect = container.getBoundingClientRect()
      const scrollableHeight = rect.height - window.innerHeight

      if (scrollableHeight <= 0) return

      const progress = clamp(-rect.top / scrollableHeight, 0, 1)
      latestProgress = progress

      if (!rafId) {
        rafId = requestAnimationFrame(() => {
          updateVisuals(latestProgress)
          rafId = 0
        })
      }
    }

    // Initial positioning
    onScroll()

    // Completely passive scroll listener for 100% native 120fps/60fps compositor thread
    window.addEventListener("scroll", onScroll, { passive: true })
    window.addEventListener("resize", onScroll, { passive: true })

    return () => {
      window.removeEventListener("scroll", onScroll)
      window.removeEventListener("resize", onScroll)
      if (rafId) cancelAnimationFrame(rafId)
    }
  }, [])

  return (
    <div
      ref={containerRef}
      className={className}
      style={{
        position: "relative",
        height: "230vh", // Generous natural scroll distance
        width: "100%",
        background: COL_BG,
        ...style,
      }}
    >
      {/* Sticky viewport container (stays pinned during the 230vh scroll) */}
      <div
        style={{
          position: "sticky",
          top: 0,
          left: 0,
          width: "100%",
          height: "100vh",
          minHeight: "680px",
          overflow: "hidden",
          contain: "paint layout",
        }}
      >
        {/* Layer 1: Forest Image */}
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
            willChange: "transform",
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

        {/* Layer 2: Window Image Overlay */}
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
            willChange: "transform, opacity",
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
            padding: "0 8% 6vh",
            textAlign: "center",
            opacity: 0,
            pointerEvents: "none",
            zIndex: 4,
            willChange: "transform, opacity",
          }}
        >
          <span
            style={{
              fontFamily: SANS,
              fontWeight: 800,
              fontSize: "clamp(76px, 19vw, 250px)",
              lineHeight: 0.95,
              letterSpacing: "-0.04em",
              background:
                "linear-gradient(180deg, #ffffff 20%, #f6edd9 60%, rgba(210, 175, 120, 0.6) 95%)",
              WebkitBackgroundClip: "text",
              WebkitTextFillColor: "transparent",
              filter:
                "drop-shadow(0 14px 45px rgba(0,0,0,0.85)) drop-shadow(0 0 35px rgba(255,225,150,0.3))",
            }}
          >
            {brandMark}
          </span>
          <div
            style={{
              marginTop: "20px",
              display: "inline-flex",
              alignItems: "center",
              padding: "8px 22px",
              borderRadius: "9999px",
              background: "transparent",
              border: "1px solid rgba(255, 244, 232, 0.35)",
            }}
          >
            <span
              style={{
                fontFamily: SANS,
                fontWeight: 600,
                fontSize: "clamp(11px, 1.3vw, 13px)",
                letterSpacing: "0.26em",
                color: "#f5ebd9",
                textTransform: "uppercase",
              }}
            >
              Timber supply, connected.
            </span>
          </div>
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
            willChange: "transform, opacity",
          }}
        >
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
          <svg
            width="14"
            height="18"
            viewBox="0 0 14 18"
            style={{ animation: "forest-bounce 1.6s ease-in-out infinite" }}
          >
            <style>{`
              @keyframes forest-bounce {
                0%, 100% { transform: translateY(0); opacity: 0.5; }
                50% { transform: translateY(5px); opacity: 1; }
              }
            `}</style>
            <path
              d="M7 1 L7 17 M2 12 L7 17 L12 12"
              stroke="currentColor"
              strokeWidth="1.5"
              fill="none"
              strokeLinecap="round"
              strokeLinejoin="round"
            />
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
              willChange: "transform",
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
    </div>
  )
}
