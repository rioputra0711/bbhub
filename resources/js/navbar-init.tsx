import React from 'react';
import { createRoot } from 'react-dom/client';
import { NavBar } from './components/ui/tubelight-navbar';
import { Home, Package, LayoutGrid, Info, Truck, ShoppingBag, User } from 'lucide-react';
import { locale, t } from './lib/i18n';

const container = document.getElementById('navbar-root');

if (container) {
  const active = container.dataset.active ?? 'home';
  const tone = container.dataset.tone === 'dark' ? 'dark' : 'light';

  const navItems = [
    { name: t('nav.products'), url: '/products', icon: Package, key: 'products' },
    { name: t('nav.categories'), url: '#', icon: LayoutGrid, key: 'categories' },
    { name: t('nav.home'), url: '/', icon: Home, key: 'home' },
    { name: t('nav.about'), url: '#', icon: Info, key: 'about' },
    { name: t('nav.logistics'), url: '#', icon: Truck, key: 'logistics' }
  ];

  const navActions = [
    { name: t('nav.login'), url: '#', icon: User },
    { name: t('nav.bag'), url: '#', icon: ShoppingBag, hideLabel: true }
  ];

  const activeItem = navItems.find((item) => item.key === active) ?? navItems[2];

  const root = createRoot(container);
  root.render(
    <NavBar
      items={navItems.map(({ key, ...item }) => item)}
      actions={navActions}
      languages={['EN', 'ID']}
      tone={tone}
      defaultLanguage={locale === 'id' ? 'ID' : 'EN'}
      defaultActive={activeItem.name}
      onLanguageChange={(code) => {
        document.documentElement.lang = code === 'ID' ? 'id' : 'en';
        window.location.href = `/language/${code.toLowerCase()}`;
      }}
    />
  );
}
