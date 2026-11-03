import React from 'react';
import { createRoot } from 'react-dom/client';
import TimberScrollHero from './components/ui/timber-scroll-hero';
import { t } from './lib/i18n';

const container = document.getElementById('hero-root');
if (container) {
  const root = createRoot(container);
  root.render(
    <TimberScrollHero
      title={t('hero.title')}
      scrollHint={t('hero.scroll')}
      pillText={t('hero.pill')}
      signatureLabel={t('hero.by')}
      windowAlt={t('alt.window')}
    />
  );
}
