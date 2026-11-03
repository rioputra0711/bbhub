import * as React from "react"
import { cn } from "@/lib/utils"

export interface ButtonProps
  extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: "default" | "outline" | "ghost"
  size?: "default" | "sm" | "lg" | "icon"
}

const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
  ({ className, variant = "default", size = "default", ...props }, ref) => {
    return (
      <button
        ref={ref}
        className={cn(
          "inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer",
          variant === "outline" &&
            "border border-[#e7e4dc] bg-white shadow-sm hover:bg-neutral-100 text-[#292821]",
          variant === "ghost" && "hover:bg-neutral-100 text-[#292821]",
          size === "icon" && "h-8 w-8",
          className
        )}
        {...props}
      />
    )
  }
)
Button.displayName = "Button"

export { Button }
