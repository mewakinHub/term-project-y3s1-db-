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
    case 'browse':
      return '/browse';
      break;
    case 'library':
      return '/library';
      break;
    default: break;
  }
}