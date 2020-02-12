/*-------------------------------PROGRAM OF MENU --------------------------------------------------------------*/
#include<windows.h>
/*Ids of menus*/
#define NEW_FILE_MENU 1
#define OPEN_FILE_MENU 2

HMENU hMenu;
/*----------Create menu and sub menus-------*/
void NewMenu(HWND hwnd)
{
    hMenu=CreateMenu();
    HMENU hFileMenu=CreateMenu();

    AppendMenu(hFileMenu,MF_STRING,NEW_FILE_MENU,"New File");
    AppendMenu(hFileMenu,MF_STRING,OPEN_FILE_MENU,"Open File");

    AppendMenu(hMenu,MF_POPUP,(UINT_PTR)hFileMenu,"File");
    SetMenu(hwnd,hMenu);

}


/* Window procedure function that handle events */

LRESULT CALLBACK  WndProc(HWND hwnd, UINT msg, WPARAM wParam, LPARAM lParam)
{
    HDC hdc;
    PAINTSTRUCT ps;
    RECT rec;
    HWND hwndBt1,hwndLb1,hwndEd1,hwndBt2;
	switch(msg)
	{
        case WM_CREATE:
            NewMenu(hwnd);

        break;



        case WM_PAINT:
            hdc=BeginPaint(hwnd,&ps);
            //GetClientRect(hwnd,&rec);
            //DrawText(hdc,"Hello World",-1,&rec,DT_SINGLELINE|DT_CENTER|DT_VCENTER);
            //MoveToEx(hdc,100,100,NULL);
            //LineTo(hdc,200,200);
            //Ellipse(hdc,100,100,150,150);
          // MoveT
            EndPaint(hwnd,&ps);
            break;

		case WM_DESTROY:
		    PostQuitMessage(0);
			break;

	}
    return DefWindowProc(hwnd,msg,wParam,lParam);
}

/*-----------------------Main function-----------------*/
int WINAPI WinMain(HINSTANCE hInst,HINSTANCE hPrevInst, LPSTR lpcmdline,int icmdshow)
{

    HWND hwnd;
    MSG msg;
    WNDCLASS wc;

    /*---window class structure that defines properties--------*/

    wc.style=CS_HREDRAW|CS_VREDRAW;
    wc.lpfnWndProc=WndProc;
    wc.cbClsExtra=0;
    wc.cbWndExtra=0;
    wc.hInstance=hInst;
    wc.hIcon=LoadIcon(NULL,IDI_EXCLAMATION);
    wc.hCursor=LoadCursor(NULL,IDC_HELP);
    wc.hbrBackground=(HBRUSH)(COLOR_WINDOW+1);
    wc.lpszMenuName=NULL;
    wc.lpszClassName="WindowClass";

    /*---Register the window class structure----- */

    if(!RegisterClass(&wc))
    {
        MessageBox(NULL,"Registration Failed","Error",1);
        return 0;
    }
    /*-----Call Create Window function-----*/

    hwnd=CreateWindow("WindowClass","Simple Window",WS_OVERLAPPEDWINDOW,100,100,500,500,NULL,NULL,hInst,NULL);

    /*-----Call Show Window function-----*/

    ShowWindow(hwnd,icmdshow);
    UpdateWindow(hwnd);

    /*-----Message Loop-----*/

    while(GetMessage(&msg,NULL,0,0))
    {
        TranslateMessage(&msg);
        DispatchMessage(&msg);

    }

    return 0;
}


