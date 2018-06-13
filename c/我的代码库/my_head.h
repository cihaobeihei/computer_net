#define OUT
#define IN
extern int get_mem(IN int n_values, ...);
extern int free_mem(IN int n_values, ...);
extern int inverse(char *str);
extern int get_no_space_count(IN const char *str,OUT int *cnt_p);
extern int get_num_sub(IN const char*dest, IN const char*sub);
extern int replaceSubstr(IN char *src, OUT char **dst, IN char *sub ,IN char *new_sub);
extern int get_no_space_string(IN const char *src_str,char OUT **des_str);
