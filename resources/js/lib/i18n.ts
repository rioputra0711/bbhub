type Dict = Record<string, unknown>;

let dict: Dict = {};

const node = typeof document !== "undefined" ? document.getElementById("bbhub-i18n") : null;
if (node?.textContent) {
  try {
    dict = JSON.parse(node.textContent) as Dict;
  } catch {
    dict = {};
  }
}

export const locale: string =
  typeof document !== "undefined" ? document.documentElement.lang || "en" : "en";

function resolve(path: string): unknown {
  return path.split(".").reduce<unknown>((acc, key) => {
    if (acc && typeof acc === "object") return (acc as Dict)[key];
    return undefined;
  }, dict);
}

/** Translate a `site.*` key. Falls back to the key's last segment. */
export function t(path: string, fallback?: string): string {
  const value = resolve(path);
  if (typeof value === "string") return value;
  return fallback ?? path.split(".").pop() ?? path;
}

/** Read a translated list of objects (e.g. `carousel.items`). */
export function tList<T = Record<string, string>>(path: string): T[] {
  const value = resolve(path);
  return Array.isArray(value) ? (value as T[]) : [];
}

export function isIndonesian(): boolean {
  return locale.toLowerCase().startsWith("id");
}
