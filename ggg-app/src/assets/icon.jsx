export function Icon( icon ) {
  switch(icon) {
    case 'mail':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" stroke-width="0" fill="currentColor" />
        <path d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" stroke-width="0" fill="currentColor" />
      </svg>;
    case 'id':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
        <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
        <path d="M15 8l2 0" />
        <path d="M15 12l2 0" />
        <path d="M7 16l10 0" />
      </svg>;
    case 'key':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="M288-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T48-480q0-100 70-170t170-70q78 0 140.5 46.5T516-552h324l72 72-132 159-84-87-72 72-72-72h-36q-24 75-86.925 121.5Q366.149-240 288-240Z" />
      </svg>;
    case 'back':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="m343.152-438.5 195.739 195.739L480-183.869 183.869-480 480-776.131l58.891 58.892L343.152-521.5h432.979v83H343.152Z"/>
      </svg>;
    case 'featured':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
        <path fill='currentColor' d="m668-340 152-130 120 10-176 153 52 227-102-62-46-198Zm-94-292-42-98 46-110 92 217-96-9ZM294-247l126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM173-80l65-281L20-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L173-80Zm247-340Z"/>
      </svg>;
    case 'browse':
      return <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
        <path d="M18.5 18.5l2.5 2.5" />
        <path d="M4 6h16" />
        <path d="M4 12h4" />
        <path d="M4 18h4" />
      </svg>;
    case 'library':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="M144-456v-288.272Q144-774 165.5-795t50.5-21h228v360H144Zm372-360h228q29.7 0 50.85 21.15Q816-773.7 816-744v168H516v-240Zm0 672v-360h300v288q0 29-21.15 50.5T744-144H516ZM144-384h300v240H216q-29 0-50.5-21.5T144-216v-168Z"/>
      </svg>;
    case 'friends':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
        <path fill='currentColor' d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Z"/>
      </svg>;
    case 'adjust':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
        <path fill='currentColor' d="M520-600v-80h120v-160h80v160h120v80H520Zm120 480v-400h80v400h-80Zm-400 0v-160H120v-80h320v80H320v160h-80Zm0-320v-400h80v400h-80Z"/>
      </svg>;
    case 'search':
      return <svg fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
        <path fill='currentColor' d="M764.522-134.913 523.848-375.587q-29.761 21.044-65.434 33.065-35.672 12.022-76.292 12.022-102.187 0-173.861-71.674Q136.587-473.848 136.587-576q0-102.152 71.674-173.826Q279.935-821.5 382.087-821.5q102.152 0 173.826 71.674 71.674 71.674 71.674 173.861 0 40.859-12.022 76.292-12.021 35.434-33.065 64.956l240.913 241.152-58.891 58.652ZM382.087-413.5q67.848 0 115.174-47.326Q544.587-508.152 544.587-576q0-67.848-47.326-115.174Q449.935-738.5 382.087-738.5q-67.848 0-115.174 47.326Q219.587-643.848 219.587-576q0 67.848 47.326 115.174Q314.239-413.5 382.087-413.5Z"/>
      </svg>;
    default: break;
  }
}
/*
case '':
  return ;
  break;
*/