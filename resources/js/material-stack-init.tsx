import React from 'react';
import { createRoot } from 'react-dom/client';
import MaterialCardStack from './components/ui/material-card-stack';

const container = document.getElementById('material-stack-root');
if (container) {
  const root = createRoot(container);
  root.render(<MaterialCardStack />);
}
