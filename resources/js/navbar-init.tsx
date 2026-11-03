import React from 'react';
import { createRoot } from 'react-dom/client';
import { NavBar } from './components/ui/tubelight-navbar';
import { Home, Package, LayoutGrid, Info, Truck } from 'lucide-react';

const navItems = [
  { name: 'Home', url: '#', icon: Home },
  { name: 'Products', url: '#', icon: Package },
  { name: 'Categories', url: '#', icon: LayoutGrid },
  { name: 'About', url: '#', icon: Info },
  { name: 'Logistics', url: '#', icon: Truck }
];

const container = document.getElementById('navbar-root');
if (container) {
  const root = createRoot(container);
  root.render(<NavBar items={navItems} />);
}
