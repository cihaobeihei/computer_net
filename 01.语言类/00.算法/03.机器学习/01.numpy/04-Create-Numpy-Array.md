## 04 创建 ``numpy.array``


```python
import numpy as np
```

### ``numpy.array``


```python
nparr = np.array([i for i in range(10)])
nparr
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])



### 其他创建 ``numpy.array`` 的方法

#### ``zeros``


```python
np.zeros(10)
```




    array([ 0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.])




```python
np.zeros(10, dtype=float)
```




    array([ 0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.,  0.])




```python
np.zeros((3, 5))
```




    array([[ 0.,  0.,  0.,  0.,  0.],
           [ 0.,  0.,  0.,  0.,  0.],
           [ 0.,  0.,  0.,  0.,  0.]])




```python
np.zeros(shape=(3, 5), dtype=int)
```




    array([[0, 0, 0, 0, 0],
           [0, 0, 0, 0, 0],
           [0, 0, 0, 0, 0]])



#### ones


```python
np.ones(10)
```




    array([ 1.,  1.,  1.,  1.,  1.,  1.,  1.,  1.,  1.,  1.])




```python
np.ones((3, 5))
```




    array([[ 1.,  1.,  1.,  1.,  1.],
           [ 1.,  1.,  1.,  1.,  1.],
           [ 1.,  1.,  1.,  1.,  1.]])



#### full


```python
np.full((3, 5), 666)
```




    array([[666, 666, 666, 666, 666],
           [666, 666, 666, 666, 666],
           [666, 666, 666, 666, 666]])




```python
np.full(fill_value=666, shape=(3, 5))
```




    array([[666, 666, 666, 666, 666],
           [666, 666, 666, 666, 666],
           [666, 666, 666, 666, 666]])



#### arange


```python
[i for i in range(0, 20, 2)]
```




    [0, 2, 4, 6, 8, 10, 12, 14, 16, 18]




```python
np.arange(0, 20, 2)
```




    array([ 0,  2,  4,  6,  8, 10, 12, 14, 16, 18])




```python
[i for i in range(0, 1, 0.2)]
```


    ---------------------------------------------------------------------------
    
    TypeError                                 Traceback (most recent call last)
    
    <ipython-input-43-d0579096bf02> in <module>()
    ----> 1 [i for i in range(0, 1, 0.2)]


    TypeError: 'float' object cannot be interpreted as an integer



```python
np.arange(0, 1, 0.2)
```




    array([ 0. ,  0.2,  0.4,  0.6,  0.8])




```python
[i for i in range(0, 10)]
```




    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]




```python
np.arange(0, 10)
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
[i for i in range(10)]
```




    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]




```python
np.arange(10)
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])



#### linspace


```python
np.linspace(0, 20, 10)
```




    array([  0.        ,   2.22222222,   4.44444444,   6.66666667,
             8.88888889,  11.11111111,  13.33333333,  15.55555556,
            17.77777778,  20.        ])




```python
np.linspace(0, 20, 11)
```




    array([  0.,   2.,   4.,   6.,   8.,  10.,  12.,  14.,  16.,  18.,  20.])




```python
np.linspace(0, 1, 5)
```




    array([ 0.  ,  0.25,  0.5 ,  0.75,  1.  ])



#### random

##### randint


```python
np.random.randint(0, 10)    # [0, 10)之间的随机数
```




    5




```python
np.random.randint(0, 10, 10)
```




    array([2, 6, 1, 8, 1, 6, 8, 0, 1, 4])




```python
np.random.randint(0, 1, 10)
```




    array([0, 0, 0, 0, 0, 0, 0, 0, 0, 0])




```python
np.random.randint(0, 10, size=10)
```




    array([3, 4, 9, 9, 5, 2, 3, 3, 2, 1])




```python
np.random.randint(0, 10, size=(3,5))
```




    array([[1, 5, 3, 8, 5],
           [2, 7, 9, 6, 0],
           [0, 9, 9, 9, 7]])




```python
np.random.randint(10, size=(3,5))
```




    array([[4, 8, 3, 7, 2],
           [9, 9, 2, 4, 4],
           [1, 5, 1, 7, 7]])



##### seed


```python
np.random.seed(666)
```


```python
np.random.randint(0, 10, size=(3, 5))
```




    array([[2, 6, 9, 4, 3],
           [1, 0, 8, 7, 5],
           [2, 5, 5, 4, 8]])




```python
np.random.seed(666)
np.random.randint(0, 10, size=(3,5))
```




    array([[2, 6, 9, 4, 3],
           [1, 0, 8, 7, 5],
           [2, 5, 5, 4, 8]])



##### random


```python
np.random.random()
```




    0.7315955468480113




```python
np.random.random((3,5))
```




    array([[ 0.8578588 ,  0.76741234,  0.95323137,  0.29097383,  0.84778197],
           [ 0.3497619 ,  0.92389692,  0.29489453,  0.52438061,  0.94253896],
           [ 0.07473949,  0.27646251,  0.4675855 ,  0.31581532,  0.39016259]])



##### normal


```python
np.random.normal()
```




    0.9047266176428719




```python
np.random.normal(10, 100)
```




    -72.62832650185376




```python
np.random.normal(0, 1, (3, 5))
```




    array([[ 0.82101369,  0.36712592,  1.65399586,  0.13946473, -1.21715355],
           [-0.99494737, -1.56448586, -1.62879004,  1.23174866, -0.91360034],
           [-0.27084407,  1.42024914, -0.98226439,  0.80976498,  1.85205227]])



`np.random.<TAB>` 查看random中的更多方法


```python
np.random?
```


```python
np.random.normal?
```


```python
help(np.random.normal)
```

    Help on built-in function normal:
    
    normal(...) method of mtrand.RandomState instance
        normal(loc=0.0, scale=1.0, size=None)
        
        Draw random samples from a normal (Gaussian) distribution.
        
        The probability density function of the normal distribution, first
        derived by De Moivre and 200 years later by both Gauss and Laplace
        independently [2]_, is often called the bell curve because of
        its characteristic shape (see the example below).
        
        The normal distributions occurs often in nature.  For example, it
        describes the commonly occurring distribution of samples influenced
        by a large number of tiny, random disturbances, each with its own
        unique distribution [2]_.
        
        Parameters
        ----------
        loc : float or array_like of floats
            Mean ("centre") of the distribution.
        scale : float or array_like of floats
            Standard deviation (spread or "width") of the distribution.
        size : int or tuple of ints, optional
            Output shape.  If the given shape is, e.g., ``(m, n, k)``, then
            ``m * n * k`` samples are drawn.  If size is ``None`` (default),
            a single value is returned if ``loc`` and ``scale`` are both scalars.
            Otherwise, ``np.broadcast(loc, scale).size`` samples are drawn.
        
        Returns
        -------
        out : ndarray or scalar
            Drawn samples from the parameterized normal distribution.
        
        See Also
        --------
        scipy.stats.norm : probability density function, distribution or
            cumulative density function, etc.
        
        Notes
        -----
        The probability density for the Gaussian distribution is
        
        .. math:: p(x) = \frac{1}{\sqrt{ 2 \pi \sigma^2 }}
                         e^{ - \frac{ (x - \mu)^2 } {2 \sigma^2} },
        
        where :math:`\mu` is the mean and :math:`\sigma` the standard
        deviation. The square of the standard deviation, :math:`\sigma^2`,
        is called the variance.
        
        The function has its peak at the mean, and its "spread" increases with
        the standard deviation (the function reaches 0.607 times its maximum at
        :math:`x + \sigma` and :math:`x - \sigma` [2]_).  This implies that
        `numpy.random.normal` is more likely to return samples lying close to
        the mean, rather than those far away.
        
        References
        ----------
        .. [1] Wikipedia, "Normal distribution",
               http://en.wikipedia.org/wiki/Normal_distribution
        .. [2] P. R. Peebles Jr., "Central Limit Theorem" in "Probability,
               Random Variables and Random Signal Principles", 4th ed., 2001,
               pp. 51, 51, 125.
        
        Examples
        --------
        Draw samples from the distribution:
        
        >>> mu, sigma = 0, 0.1 # mean and standard deviation
        >>> s = np.random.normal(mu, sigma, 1000)
        
        Verify the mean and the variance:
        
        >>> abs(mu - np.mean(s)) < 0.01
        True
        
        >>> abs(sigma - np.std(s, ddof=1)) < 0.01
        True
        
        Display the histogram of the samples, along with
        the probability density function:
        
        >>> import matplotlib.pyplot as plt
        >>> count, bins, ignored = plt.hist(s, 30, normed=True)
        >>> plt.plot(bins, 1/(sigma * np.sqrt(2 * np.pi)) *
        ...                np.exp( - (bins - mu)**2 / (2 * sigma**2) ),
        ...          linewidth=2, color='r')
        >>> plt.show()


​    
