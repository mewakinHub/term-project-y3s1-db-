export function Icon( icon ) {
  switch(icon) {
    case 'mail':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" stroke-width="0" fill="currentColor" />
        <path d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" stroke-width="0" fill="currentColor" />
      </svg>
      ;
      break;
    case 'id':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
        <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
        <path d="M15 8l2 0" />
        <path d="M15 12l2 0" />
        <path d="M7 16l10 0" />
      </svg>
      ;
      break;
    case 'key':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="M288-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T48-480q0-100 70-170t170-70q78 0 140.5 46.5T516-552h324l72 72-132 159-84-87-72 72-72-72h-36q-24 75-86.925 121.5Q366.149-240 288-240Z" />
      </svg>
      ;
      break;
    case 'back':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="m343.152-438.5 195.739 195.739L480-183.869 183.869-480 480-776.131l58.891 58.892L343.152-521.5h432.979v83H343.152Z"/>
      </svg>
      ;
      break;
    case 'featured':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
        <path fill='currentColor' d="m363-310 117-71 117 71-31-133 104-90-137-11-53-126-53 126-137 11 104 90-31 133ZM480-28 346-160H160v-186L28-480l132-134v-186h186l134-132 134 132h186v186l132 134-132 134v186H614L480-28Z"/>
      </svg>
      ;
      break;
    case 'browse':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
        <path d="M18.5 18.5l2.5 2.5" />
        <path d="M4 6h16" />
        <path d="M4 12h4" />
        <path d="M4 18h4" />
      </svg>
      ;
      break;
    case 'library':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="M144-456v-288.272Q144-774 165.5-795t50.5-21h228v360H144Zm372-360h228q29.7 0 50.85 21.15Q816-773.7 816-744v168H516v-240Zm0 672v-360h300v288q0 29-21.15 50.5T744-144H516ZM144-384h300v240H216q-29 0-50.5-21.5T144-216v-168Z"/>
      </svg>
      ;
      break;
    default: break;
  }
}
/*
case '':
  return ;
  break;
*/