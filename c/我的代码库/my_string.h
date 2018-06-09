#define _CRT_SECURE_NO_WARNINGS
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include <ctype.h>
#define OUT
#define IN


//**********************************************************************************
//Take the pointer that point to fist address of the string and reverse the string
//**********************************************************************************

int inverse(char *str)
{
	char *begin = str;
	char *end = str + strlen(str) - 1;
	char tmp = 0;

	if (str == NULL) {
		fprintf(stderr, " str == NULL\n");
		return -1;
	}

	while (end > begin) {
		tmp = *end;
		*end = *begin;
		*begin = tmp;
		begin++;
		end--;
	}

	return 0;
}

/*
int main(void)
{
	char str[] = "ABC !@#123";
	inverse(str); //abcdefg
	printf("str : %s\n", str);
	getchar();
	return 0;
}
*/


//*********************************************************************************************
//Takes the first address of the string, and a cosmetic variable, calculates the number of non-null characters in the string, and assigns values to the shaping
//*********************************************************************************************
int get_no_space_count(IN const char *str,OUT int *cnt_p)
{
	const char *p = NULL;
	const char *q = NULL;

	int cnt = 0;



	if (str == NULL || cnt_p == NULL) {
		fprintf(stderr, " str == NULL || cnt_p == NULL \n");
		return -1;
	}

	p = str;//Points to the first element of the string
	q = str + strlen(str) - 1; //Points to the end element of the string

	//The left traversal
	while (isspace(*p) && *p != '\0')
	{
		p++;
	}


	while (isspace(*q) && (q >p))
	{
		q--;
	}

	cnt = q - p + 1;

	*cnt_p = cnt;

	return 0;
}
/*
int main(void)
{
	char *str = "      a      ";
	int cnt = 0;

	get_no_space_count(str, &cnt);

	printf("cnt = %d\n", cnt);
	getchar();
	return 0;
}
*/










//*********************************************************************************************
//count number of substring in dest string.
//*********************************************************************************************
int get_num_sub(IN const char*dest, IN const char*sub) {

	if (dest == NULL || sub == NULL) {
		fprintf(stderr, "(src == NULL || sub_str == NULL\n");
		return -1;
	}
	const char *p = NULL;
	int count=0;
	int lenth=0;
	p = dest;
	lenth = strlen(dest);
	for (; p != NULL || lenth<strlen(sub); lenth =strlen(p), p = p + strlen(sub)) {
		p=strstr(p, sub);
		count++;
		if (p <= '\0') {
			break;
		}
	}
	return count;
}
/*
int main()
{
	char *str = "ABCertABCABCahfdjd";
	char *p = "ABC";
	int num = 0;
	num = get_num_sub(str, p);
	printf("%d\n", num);
	getchar();
	return 0;
}
*/
