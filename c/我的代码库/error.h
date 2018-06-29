#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#define LOG(format,...)\
	fprintf(stderr,"[LOG][%s:%d][%s][%s]"format,__FUNCTION__,__LINE__,__DATE__,__TIME__,##__VA_ARGS__);
#define DEBUG(format,...)\
	fprintf(stderr,"[DEBUG][%s:%d][%s][%s]"format,__FUNCTION__,__LINE__,__DATE__,__TIME__,##__VA_ARGS__);
#define ERROR(format,...)\
	fprintf(stderr,"[ERROR][%s:%d][%s][%s]"format,__FUNCTION__,__LINE__,__DATE__,__TIME__,##__VA_ARGS__);
#if 0
int main()
{
	LOG("This is LOG\n");
	DEBUG("This is DEBUG\n");
	ERROR("This is ERROR\n");
	return 0;
}
#endif
