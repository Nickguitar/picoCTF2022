#include <stdio.h>
#include <unistd.h>
int main(void) {
  char* argv[] = { "", "", NULL };
  char* envp[] = { "", "", NULL };
  if (execve("/bin/sh", argv, envp) == -1)
    perror("Could not execve");
  return 1;
}