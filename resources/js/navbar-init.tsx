import React from 'react';
import { createRoot } from 'react-dom/client';
import { NavBar } from './components/ui/tubelight-navbar';
import { Home, Package, LayoutGrid, Info, Truck, ShoppingBag } from 'lucide-react';
import { locale, t } from './lib/i18n';

const navItems = [
  { name: t('nav.products'), url: '#', icon: Package },
  { name: t('nav.categories'), url: '#', icon: LayoutGrid },
  { name: t('nav.home'), url: '#', icon: Home },
  { name: t('nav.about'), url: '#', icon: Info },
  { name: t('nav.logistics'), url: '#', icon: Truck }
];

const navActions = [
  { name: t('nav.login'), url: '#' },
  { name: t('nav.bag'), url: '#', icon: ShoppingBag, hideLabel: true }
];

const navLanguages = ['EN', 'ID'];

const container = document.getElementById('navbar-root');
if (container) {
  const root = createRoot(container);
  root.render(
    <NavBar
      items={navItems}
      actions={navActions}
      languages={navLanguages}
      defaultLanguage={locale === 'id' ? 'ID' : 'EN'}
      defaultActive={t('nav.home')}
      onLanguageChange={(code) => {
        document.documentElement.lang = code === 'ID' ? 'id' : 'en';
        window.location.href = `/language/${code.toLowerCase()}`;
      }}
    />
  );
}
