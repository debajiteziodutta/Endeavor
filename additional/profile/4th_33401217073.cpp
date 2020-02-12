#include<windows.h>
LRESULT CALLBACK  WndProc(HWND hwnd, UINT msg, WPARAM wParam, LPARAM lParam)
{
    HDC hdc;
    PAINTSTRUCT ps;
    RECT rec;

	switch(msg)
	{
        case WM_LBUTTONDOWN:
            MessageBox(hwnd,"Mouse Button Clicked..","Message Example",MB_OKCANCEL);
            break;
        case WM_CREATE:
           MessageBox(hwnd,"Create a window soon...","Message Example",MB_OKCANCEL);
            break;

        case WM_KEYDOWN:
            MessageBox(hwnd,"Key Pressed...","Message Example",MB_OKCANCEL);
            break;


        case WM_PAINT:
            hdc=BeginPaint(hwnd,&ps);
            GetClientRect(hwnd,&rec);
            DrawText(hdc,"Hello World",-1,&rec,DT_SINGLELINE|DT_CENTER|DT_VCENTER);
            EndPaint(hwnd,&ps);
            break;

		case WM_DESTROY:
		    MessageBox(hwnd,"Close the window ...","Message Example",MB_OKCANCEL);
			PostQuitMessage(0);
			break;

	}
    return DefWindowProc(hwnd,msg,wParam,lParam);
}

int WINAPI WinMain(HINSTANCE hInst,HINSTANCE hPrevInst, LPSTR lpcmdline,int icmdshow)
{

    HWND hwnd;
    MSG msg;
    WNDCLASS wc;

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

    if(!RegisterClass(&wc))
    {
        MessageBox(NULL,"Registration Failed","Error",1);
        return 0;
    }
    hwnd=CreateWindow("WindowClass","Simple Window",WS_OVERLAPPEDWINDOW,100,100,500,500,NULL,NULL,hInst,NULL);

    ShowWindow(hwnd,icmdshow);
    UpdateWindow(hwnd);

    while(GetMessage(&msg,NULL,0,0))
    {
        TranslateMessage(&msg);
        DispatchMessage(&msg);

    }

    return 0;
}


