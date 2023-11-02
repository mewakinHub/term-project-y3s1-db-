export function Route( page ) {
  switch(page) {
    case 'login':
      return '/login';
      break;
    case 'signup':
      return '/signup';
      break;
    case 'featured':
      return '/featured';
      break;
    default: break;
  }
}