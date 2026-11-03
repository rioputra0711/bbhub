import React from 'react';
import { createRoot } from 'react-dom/client';
import { NavBar } from './components/ui/tubelight-navbar';
import { Home, Package, LayoutGrid, Info, Truck, ShoppingBag } from 'lucide-react';

const navItems = [
  { name: 'Products', url: '#', icon: Package },
  { name: 'Categories', url: '#', icon: LayoutGrid },
  { name: 'Home', url: '#', icon: Home },
  { name: 'About', url: '#', icon: Info },
  { name: 'Logistics', url: '#', icon: Truck }
];

const navActions = [
  { name: 'Login', url: '#' },
  { name: 'Bag', url: '#', icon: ShoppingBag, hideLabel: true }
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
      defaultActive="Home"
      onLanguageChange={(code) => {
        document.documentElement.lang = code === 'ID' ? 'id' : 'en';
      }}
    />
  );
}
