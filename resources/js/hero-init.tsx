import React from 'react';
import { createRoot } from 'react-dom/client';
import TimberScrollHero from './components/ui/timber-scroll-hero';

const container = document.getElementById('hero-root');
if (container) {
  const root = createRoot(container);
  root.render(<TimberScrollHero />);
}
