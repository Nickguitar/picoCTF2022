from sympy import *
import random
def pollard_rho(n):
    if n%2 == 0: return 2
    if isprime(n): return n # define it somehow, e.g. return False, then it infinite loops on primes
    while True:
        c = random.randint(2, n-1)
        f = lambda x: x**2 + c 
        x = y = 2 
        d = 1 
        while d == 1:
            x = f(x) % n 
            y = f(f(y)) % n 
            d = gcd((x - y) % n, n)
        if d != n: return d

print(pollard_rho(17))