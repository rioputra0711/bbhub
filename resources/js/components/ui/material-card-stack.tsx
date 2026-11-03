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
  return (
    <div className="w-full flex justify-center py-2">
      <div className="w-full max-w-5xl">
        <CardStack
          items={materialItems}
          initialIndex={1}
          autoAdvance={true}
          intervalMs={3200}
          pauseOnHover={true}
          showDots={true}
          cardWidth={480}
          cardHeight={290}
        />
      </div>
    </div>
  );
}

export default MaterialCardStack;
