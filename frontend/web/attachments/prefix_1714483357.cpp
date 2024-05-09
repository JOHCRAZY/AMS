#include<iostream>
using namespace std;
int main(){
	int n;
	cout<<"Input the number of rows:";
	cin>>n;
	for(int i=n; i>=1; i--){
		
		for(int j=n-1; j>=1; j--)
		cout<<"";
		{
			for(int j=i; j>=1; j--)
			cout<<"  "<<j;
		}
		cout<<"\n";
	}
}
