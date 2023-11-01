export function Route( page ) {
  switch(page) {
    case 'signup':
      return '/signup';
      break;
    case 'store':
      return '/store';
      break;
    default: break;
  }
}