import React from "react";
import { CardStack, CardStackItem } from "./card-stack";
import { t, tList } from "@/lib/i18n";

const materialMeta = [
  { id: 1, imageSrc: "/images/serat/cat-solid-wood.png" },
  { id: 2, imageSrc: "/images/serat/cat-processed-wood.png" },
  { id: 3, imageSrc: "/images/serat/cat-custom-size.png" },
  { id: 4, imageSrc: "/images/serat/stock-teak-kd.png" },
  { id: 5, imageSrc: "/images/serat/stock-mahoni.png" },
];

type MaterialText = {
  tag?: string;
  title?: string;
  description?: string;
};

const materialText = tList<MaterialText>("materials.items");

const materialItems: CardStackItem[] = materialMeta.map((meta, index) => {
  const text = materialText[index] ?? {};

  return {
    id: meta.id,
    tag: text.tag ?? "",
    title: text.title ?? "",
    description: text.description ?? "",
    imageSrc: meta.imageSrc,
    href: "#",
  };
});

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
          goToLabel={(title) => t("stack.go_to").replace(":title", title)}
          placeholder={t("stack.placeholder")}
        />
      </div>
    </div>
  );
}

export default MaterialCardStack;
