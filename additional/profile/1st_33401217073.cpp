/*------------------------------------------------------------CHILD WINDOW CONTROL-------------------------------------*/
#include<windows.h>

/* Window procedure function that handle events */
LRESULT CALLBACK  WndProc(HWND hwnd, UINT msg, WPARAM wParam, LPARAM lParam)
{
    HDC hdc;
    PAINTSTRUCT ps;
    RECT rec;
    HWND hwndBt1,hwndLb1,hwndEd1,hwndLb2,hwndEd2;
	switch(msg)
	{
        case WM_CREATE:
        	hwndLb1=CreateWindow("Static","Enter Your Email",WS_CHILD|WS_VISIBLE|SS_CENTER,30,20,200,20,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
            hwndEd1=CreateWindow("Edit","",WS_CHILD|WS_VISIBLE|WS_BORDER|ES_LEFT,250,20,200,20,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
            
            hwndLb2=CreateWindow("Static","Enter Yor password",WS_CHILD|WS_VISIBLE|SS_CENTER,30,80,200,20,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
            hwndEd2=CreateWindow("Edit","",WS_CHILD|WS_VISIBLE|WS_BORDER|ES_LEFT,250,80,200,20,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
            
			hwndBt1=CreateWindow("Button","Log-In",WS_CHILD|WS_VISIBLE|BS_PUSHBUTTON,160,130,150,50,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
            
            
            //hwndBt2=CreateWindow("Button","Radio",WS_CHILD|WS_VISIBLE|BS_RADIOBUTTON,100,200,80,30,hwnd,NULL,((LPCREATESTRUCT)lParam)->hInstance,NULL);
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


