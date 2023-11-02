export function Route( page ) {
  switch(page) {
    case 'login':
      return '/login';
      break;
    case 'signup':
      return '/signup';
      break;
    case 'store':
      return '/store';
      break;
    default: break;
  }
}