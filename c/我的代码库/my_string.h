/*
 *author: noble;
 *time:2018-06-09
 *vision 0.1
 *
 *des:
 *string management
 *this head need "my_mem.h".
*/
#define _CRT_SECURE_NO_WARNINGS
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include <ctype.h>
#include"my_mem.h"
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
//get two variables,one sourse string, one pointer to int number,
//count the number of no spaces characters,and assign to the int number
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

//repleace substring
//***********************************************************************************
//src: source string
//dst: need to be create new string
//sub: old substring that will be changede
//new_sub: new substring that will be replace old one.
//warning:
//Not suggest the src and dst is one point
//the dst is point to heat , so you need to free it by yourself
//***********************************************************************************
int replaceSubstr(IN char *src, OUT char **dst, IN char *sub ,IN char *new_sub)
{
        char *src_string = NULL;//save old string
        char *new_string = NULL;//save changede string
        char *temp = NULL;//save pointer that point to sub address in src
        char *cp_temp = NULL;//use to copy string to new_string
        get_mem(4, strlen(src)+3,&src_string,strlen(src)+get_num_sub(src,sub)*strlen(sub),&new_string);
        strcpy(src_string,src);
        cp_temp = src_string;
        temp = strstr(src_string, sub);
        for (; temp != NULL; temp = strstr(src_string, sub)) {
                src_string += (temp - src_string);//move src_string to point to substring address
                *src_string = '\0';
                strcat(new_string,cp_temp);
                strcat(new_string,new_sub);
                src_string += strlen(sub);//move src_string to point to behind of substring in source string
                cp_temp = src_string;
        }
        return 0;
}
/*
int main()
{
        char *src = "abc12345abc67890abc";
        char *sub = "abc";
        char *new = NULL;
        replaceSubstr(src,&new, sub,"ABC");
        return 0;
}

*/
