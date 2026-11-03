import React from "react";
import { CardStack, CardStackItem } from "./card-stack";

const materialItems: CardStackItem[] = [
  {
    id: 1,
    tag: "Primary Grade",
    title: "Solid Wood",
    description: "Teak, Mahogany, Sungkai, and Rubberwood sourced directly from certified concessions.",
    imageSrc: "/images/serat/cat-solid-wood.png",
    href: "#",
  },
  {
    id: 2,
    tag: "Engineered Timber",
    title: "Processed Wood",
    description: "Kiln dried lumber, engineered laminated panels, and precision finger joint timber.",
    imageSrc: "/images/serat/cat-processed-wood.png",
    href: "#",
  },
  {
    id: 3,
    tag: "Tailored Spec",
    title: "Custom Sizes",
    description: "Custom components, specialized profiles, and precision CNC cut-to-size lumber.",
    imageSrc: "/images/serat/cat-custom-size.png",
    href: "#",
  },
  {
    id: 4,
    tag: "Kiln Dried · MC 10-12%",
    title: "Teak Kiln Dried",
    description: "Export-ready Grade A tropical teak timber dried to precision moisture levels.",
    imageSrc: "/images/serat/stock-teak-kd.png",
    href: "#",
  },
  {
    id: 5,
    tag: "Architectural Grade",
    title: "Mahogany Sawn Timber",
    description: "Deep red grain sawn timber prepared for high-end furniture, doors, and facades.",
    imageSrc: "/images/serat/stock-mahoni.png",
    href: "#",
  },
];

export function MaterialCardStack() {
  const [viewport, setViewport] = React.useState(() =>
    typeof window === "undefined" ? 1440 : window.innerWidth,
  );

  React.useEffect(() => {
    const onResize = () => setViewport(window.innerWidth);
    onResize();
    window.addEventListener("resize", onResize);
    return () => window.removeEventListener("resize", onResize);
  }, []);

  const cardWidth =
    viewport < 480 ? Math.max(240, viewport - 96) : viewport < 768 ? 340 : viewport < 1024 ? 400 : 480;
  const cardHeight = viewport < 480 ? 200 : viewport < 768 ? 240 : viewport < 1024 ? 265 : 290;

  return (
    <div className="w-full flex justify-center py-2">
      <div className="w-full max-w-5xl">
        <CardStack
          items={materialItems}
          initialIndex={1}
          autoAdvance={true}
          intervalMs={3000}
          springStiffness={160}
          springDamping={30}
          pauseOnHover={true}
          showDots={true}
          cardWidth={cardWidth}
          cardHeight={cardHeight}
          maxVisible={viewport < 768 ? 3 : 7}
        />
      </div>
    </div>
  );
}

export default MaterialCardStack;
