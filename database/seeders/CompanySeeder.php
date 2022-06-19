<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mscompany')->insert([
            'compNama' => 'PT SIAP SEHAT',
            'compLogo' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIEAAACOCAYAAAAW9muFAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAU9UlEQVR4nO2da3AbVZbH/62HZVuK7QjHUghxHOwASZZYCcvysB3CUGCFDNlAnGJY2Ngsj2WJwckHJmYoxussRRxmaxMncVFbs8zYqamaYuNMAQWLUrtVq4ntqQw7gE3xLGTi2EksOY5xZCmRH317P8jttN7d0m290r8qla1W6/Zt3X+fc+45tyWG4zgoXN+oUt0BhdSjiEBBEYGCIgIFKCJQgCICBSgiUIAiAgUoIlBAFouA2I1lxG58/3xJ7cCIbosl1f1JZ5hsSxsTu7EIwB4AvwSA87X38C8dA9C0fPqjyRR1LW3JKktA7MYGAAOYF0AQOwGcHdFtaU1qpzKArLAExG7cBKAVwMbg1wSWQMgwgPrl0x/ZZe1YhpDRIpg3/e3wX+VhiSACnlPwi2GIbs8yi4x1B8RubAVwFlEEIIKNAM6M6La0j+i2FNHpWeaRcSIgduM2Yjeehd/vF1Bq9mX444XdlNrLKDLGHRC70QK/6Q/x+9GI4Q7C8QX8swi71DdmKmkvgnm/3wr/1SqZOETA8wH8YhiKt4FMIa3dAbEbd8Pv9+MSQIJshT9eaM32eCEtRUDsxk3zfv8g6Pn9ePklgIER3ZaGFPdDNtLKHRC7sQx+v7+VVpsJuINwnALQkm3xQlqIIDjVSxPKIuA5Br8YhuRoPNmk3B3Mp3r5KR9VPD41xnWyiHwn/C4iK1LQKbME86nedgDr5Gjf1m9Eh20ZOK8GtaNqWEc1yJ9j5DjUMPyziPfkaDwZJF0E836/FYll+iLSP2RAh20ZBp15AduLpxk8NaTFHRNqOQ4L+OOFpuXTH/XLdQC5SJoIBH5/N2SI+J2TOeiwLUPft4VR97vNrcJTQ1qs8MrmCQ/DHy9kTMk6KSIgduM2+E1/Ke22PT41Tpxegu7TS+D1ib/Kay6q8dSQVi4X4YZfCIfkaJw2soog3lSvWGz9RnTZzXBN5sT1/nyWQe2oGo+NaCn3bIGMKFnLIgIxJd5E6B8yoMtuxsCQgUp7xdMMnnfkYLVbNheR1ilo6iKYL/HK4vc9PjU6bMtwst9Iu2kA/njhHx05KJ6WxUUAwD4AB9MtXqAmgvkpXxdk8PsA0GU3S/b78VI7qsFj52SbUrrhtwqdcjQeDwmLYH7K1wWZ/H7vt4XosC2L2+/HSz7L4NERDayjGrkOkTYl67hFkGiJNxbOyRwceK+Umt+Pl1Kvf0opY7yQ8hR0XCKYT/W2Qya/32U348TpJbSbTogNE2r8/ZBWrnjBDeAQUhQvSBKB3KneE6eXoNNuTorfj5dHz2myLgUtSgRylHiF9A8ZcOC90qT7/XjJZxk8dUaLmovZkYKOKoJ0SfWmK7e5VXhsRPZ4Qfa7piKKYN7vt0LGVG+X3Uy76ZRQc9GfdZQzXlg+/VGLHI0DYUQQ7W4eGvAl3nT2+/GQySnoBRFkWqo3XUlSyZrqXVMMx3GypnqdkznosptlS/WmK5lUsmaufFp4RudWlSXep0DiLfFmG3KWrD36PLeK41bc+uOJhITAjI3qOc00M77onKZYNUuno6lK9aYrtFPQY0sW4zdPbxn75M41JQC0/7e1ci6R9pixUf1CZKibVI3rL2qKGTa+xhzOPHTYlmW9348XGiXrY0/Wut9/pFrDqtX585u0n9IUAQCAgy//ohp5E+pcsY3IXeLNNuIpWf/prrVXOl54dM6jzwuO27Sf/a2FsgjmUc0y44ZRdbH2SnTVZkKqN10RU7L+oWwpDr60Y+zsclNJhF20n8slgoUjXFGNG0bVIfFCpqV605VIKWivPhcHX6wbO/3XqyMNPo92YJvMIuDJu6R2502oC1yX0qPEm20IS9Z/eKTa1/WzBzGnEeWStV9sW5+QCESHq1dvYAu+cetmXjm0Rrn0ZWBYT/Dm2mnM3WX1Xb77Qf/gJ+mWEElzFu9VjSIAmZkByU32PWGyrZ1SiA8OAEnyXWGKCNIQxRJc53Cc/5FMFBGkGRw4kCTbAkUEaYhiCa5zOCgxgYISEyj4LYESE1zX+PMEyT2mIoI0RIkJrnM4jkOyv0cq6SKwWK79HJHH44HD4Uh2F2TDYDCgoqJi4bnT6YTT6ZTcTtZZArPZDKu1FjU11SgvLw+7z8DAAD7++CR6e3vh8XhEt93YuAurVl370D0eD1577fW4+tncvBdLlwbeDNPUtCfm+8xmM+rqtqOmphomkynsPn19fejp6YPNZovZXlbFBAaDAXV129HQUB9z38rKSlRWVsLr3YX9+w+gt7dX1DHCffDV1dWi38/DC1UqdXXb0di4K+Z+VVVVqKqqAoCYQkjF7ECWRfEGgwHt7QfDCsDr9WJgYACDg4Mhr+n1erzxxj40N+8VdZxwV151dZXk/sYjgMbGXWEFwJ+f1+sNeU2UOLlr9QOxj0Shbgl4AQhNv9frxfHj3bDZTgb4SIPBgOrqajz9dH3AgPKD0tZ2QPLxa2qqJb9v82Zr2O0WiwX9/aE3BlssFtTVbQ/Y1tnZFfH8Nm+uhcfjEeXqOABEUu8Th7oIggUwODiI/fsPhA0APR4PbDYbbDYbmpv3BlyRVmstHA4HurtPiDqu1+uFXq+HXq+X5BIqKioWBOhyuSL6dSE7dgQKoK3trbBmXnh+YuGQ/NkBVXfQ0FAfIACXy4Wmpj2iZgBtbQdgs50M2Pb00w0wGMKvZRTOMgAEXLGbN4s378Ir+vPPxX0dAO/fAb/IpQyyGDiJj0ShJgKDwYAdO+oCtu3ff0BStN/WdgAul2vhuV6vFxVYAkBPT9/C/1VVVRHFE0xNTfXC/729fVH29BMsvp4eaUFoLKTGAzSMBjURWK210Ov1C88HBgbC+tNYHDnSEfA8kr8OJvhY1dXVEfa8htVqXeiz1+sNcSEWS2XMNsxmut+xwMcEUh6JQk0EwYN1/Lg4Xx5Mb29viDUIN6DBH77T6QyYcdTUxJ4lCPcRe0UHi62mplq01RELnzUU+0gUKiIwGAwhswGpc3UhwQNSURGaZDKbrwVw/HRM6NOrqqqiXqUGgyHAt4txBTxCsen1erS3H6QmhIx1B8JUKYCEU8HBA7J+vSXCnoHHCw4so+UMhDMRoWjDze+DCXZZ5eXleOedX8NqFee6opGx7iD4ShUbZUcinnw74BeD0JVEiyeErwktj1DAkcTX398fMnU1mUxobv453n3396ir256AZZDmCtLKHdAkWAThzLqwZiBEOKDl5eVh31tRURHgvqS4Ap6jRzvQ2dkVst1kMqGxcRc+/PADNDfvlRw4Sp0eptUUUYjDEZoSToRwCZxIwhPjEoSuwOVyxR2/dHZ24dlnn8fAwEDY163WWrzzzq9DsovphiwiCBfIJUK4OoMQYS5CjEsQ5gYSnec7HA40Ne3Bs88+D5vtZEhModfr0di4S3Q9JBWmIOU/iReOYBMaLuEktATffx8YiEZzCcI0MRBqOYTHqqyMnSfgcTgcaGs7gMcffwJHj3aEiMFqrZVgEZKrAioiCDb/kfy1WMSIINLaBCC6SxC6gsHBwZCZTLCgpOLxeNDdfQKPP/5EiAWLlgYPIBMtQXAgFzxllEqwH5c6MNFcgtAVfPwx3Zy/EI/Hg6amPSGJr+C0czpAyRI4AsyfyWRKSAjCgQJiR+/hLEWwS+CXfgldQTyzAil4PB4cP94dsC1mvJSpySIgNMCKNyK2WCwBA+VyuUJMdmhyKjRwDHUJ1QEWpq+vT1Q+ItErV/pMKfmRITURBH/oVmttXNbgpZcCV+uEM9li/GqwS7BYKgOSP8Kqo5D+/vDTvaSSiTEB4M+iBc+XX311r6REUvB6BK/XK3pRSTiE1mn9estCtJ9obUMKwfEN7RwKDahOEffvPxAQG5SXl4surjQ01IesHRC7HiHSPkLrJHQxPT3SVjUHI7ZGUFFREeAWvV5v7PJ6pucJnE5n2OJKtHy6xWIJuyi1u/tExKs1uM4fqWAV7BJ4pASEwccym80LNYKGhvqwLs9gMKChoR7t7QcDth8/3i1SfMlVAfU1hvxSq+bmny9s47NmjY27AlxGRUVFwEIUnu7uEzh6tCNkezz09PQGXI2x0sSxKqC8eTeZTAHWiz8vs9kcNs09MDAQttYQFhoFAQnIct+BzWaDw+HAq6/uDUnqRMvCuVwuHDnSQdVf22wnA0QQK00c60qNFOxGO6/u7hPiBZACZLv5xOFw4JlnnoPVakVNTVXAAo5g+DuQxC7YFGYUY9X/HQ4H+vr6FlxR8CxGKvyCWKu1FuvXWyKuTvZ6vejp6YXNdlLaMjtapUEJiP5GUwD46usC/PO+2+I+WLg5dzzrENOJ4PsPgfjvQQSAC7ffj/Pr7pfyFq33uerkfKMpDTJ9wMPh8XgonxelNKAElFvT04wUeANFBGlHClSQlusJFJKLYgnSkUy+F1EhM1EsQbqhxAQKqUCxBGlH8vMEkizBmanZGbk6ouAn18v4VGwaiuDcZQ4df55zfz09lXP7k5/BsNQtd7+uO+Z0S3B52WNgmL/KLf90wlfkuupL1nqCqLUD9zSHD79jx10erphwDFgWIIQB4RhcPleAkT+WY9ajS7wX1zGcWgdP8d24WrgeKkKgYglUhIOKJZjJVY05Vy4q8RZF/Yy1V3fdR/8n8WZY4LPROfdfLpACQhiwBAgWAcv6t7k+vQmXvjaDzCg/jikVT/Ed8BbfA47RQsVyISJgCIGaJZgy6sYulBeWzOSGDeG0VxsTE0FIq99eYn29w3OYZVEAxP4Z1yXrz6FotROuT1bAPVicSF+uG6YNpZgo3QyiLoCK+Ac7GgXjV0uKxq5cuXiTfu78qsXBP5ObMAsicHoJ/jg8O+6e9pt+KahyWJju/QEFt7ow/pdS+MYW0e5nVjCnK8R42U8xk78cDEcgJQBkOC7fPORGyfCU++yaGzQTZn1+7HeJQ+Od5dB3YWb8whQpJoRJ6FLWLb4C8wPfYWqwGJNf3gj2ivIzigBA1DpcXnoXJm+sBkM4SYMfjGaWFKz6zAmfXjvmsJhKvIWJx2Sa/xryDV2dRVnCLQnQrxyH7sZJuL8zwesoATd7/cYL7pJKjJc9BE6lgyqG2ZdC/tRMyfr/HXKP3GJMuFHVizXsSgD7AFCd96m0LBatuYAbHvgGuqWXaTadEVwpKsPQhhfgvGUbiEbMTx5L5jCAFd++vSNhETD815386n/URYQw7SzBTkIYEAKwhEGs2cG1/TC/r/D/a/tMjy2C98ubwLrzEu1zWjObW4SLK+/H5RILVIQDw3HzwZ/gL8stxAR8YBhtdsD/VbEEKpY7pWLZevvHzwzR6jMT/J03b9o0mwhhWgnBRpoi4J9PD98A39fLwM1ll4tgNbm4VHovJpbfC6LKmR90qiIYVrGkvvf9ejvtvoeIgGffh9oGljCthDClNEVACAN2WoOZoSWYHYz9PcKZwMSyDRi7+QHM5hb5B35h0KmIwM0QcujPx59skav/EUUAAC0f5BQRwuxhCXYTjimgJQJ/G8CcV4fZr5aD+zH0BpRM4GrBUpxf/Qi8i1eCWRhwqiI4pmZJ0yfvPjEp53lEFQHPL/6gKyMc086y2EpTBPy+7IQB5JvlgE8r57lSg9Xm4tyarZi46Y6FwacsglMqljR99rsdSVmeLUoEPK/8Z+4mQph2wjHraIqAf40bKQZztgRg0zdeuHDrQxi7uRpEnRsw+JREMKxiSdMXv33svWSekyQR8Oz5fX4Dy6KdcEwBTREQwoDMqKE6sxSqsSIZTjd+porLcWbDzzCTtzjs4CcoAreK5Q6pCDn45X9sk9X0hyMuEQDAy7/LLyIc00oIXqYqgvn3YCoXmqGlUE1Ry47GxXT+Yvxwx99hqrjcP9hc+MFPQATHGEJavn37kaFUnWPcIuB5sUtfxhKmixBspCkCfjszsQi6YTNUM8mNF1htHkbWWuGs2AiGIFAAdETwhYrlmr4/stme1BMLQ8Ii4HnuHcMmQpguljClNEXAEoCb0yDHaYTuohEMK/+yyNFb7sO5tZsxp+H9PlURuFUs1/TDwYc6ZT8RkVATAU/Dvxe0EoLdhDAFtETAP4cvB3nOYuT+WEi1zzyXSypwZv12XCm6EQwHYGHAqYlgH0O4g0P/+mDS/X40qIsAAHa+XXAtBU1RBPz7NFN6GEZLoPXRWdU0rTfihw3bMbFsnX/gwdEWwQcM4ZpG2n4yRKXDlJFFBDxPHCm0EI5pvxYv0BEBv1/uj4UodJVAReJzEXPaPFy47X4M3/7w/ICDtgiGGY6rv/DGfXaanyttZBUBz45DRdvmLUMpTREQwgCsCoZLRhROGCX1yXXz3Rhe9zB8+Ub/+im6InAzhGtxtdYckuHjpE5SRAAA2/9tcRFLsIcQZjchTAEtEfDPVTNaFLtMyPNFr1JeNq3C2XVbMFmy6trg83/piOAwQ0jLWEt1Wvn9aCRNBDxb3zKWEcK0Eg47aYqA/6u7mgfTRRO0c4HLJ+e0eRi8cwdcN9/l38CBtghOMRzXdOm1ezLumziSLgKeh/ffsIklTDshWEdTBPzfInchllw2QkVUOLtuC86t/gnmcvLA8OdLTwTDDMc1/dh8V1JTvTRJmQh4HvyX4ob5eKGApggIB6jm1Jj8my74Fi1ZOB5FEbgZjjt0+ZU7ZSvxJouU35D636+PdwJYAf8SN6qwKgKfQVrAKJJjACqzQQBAGlgCIRtfLykjBO2EY7bSsAQcYXBx00cAc60qmaAlOMVwXItnzwZ7sj8bOUkrEfDc+wvTJkLQRQSrmlIsgmGG41quNFk6k/1ZJIOUu4Nw/OlNl/10m2sFgD2gvAo6DvYBqMxWAQBpKgKeT95yHoI/XjicgsN/AGClr7Gy5erLlRkz54+HtHQH4ajcs9TiX9XkT0HL6A6+YMA1zfzT7fakn2SKyBgR8Kx9+cZtxJ9fKKUsAjfDoWX2hbUZkeqlSVq7g3B8dfjCe98cPc9PKWnFC4cBrLgeBQBkoCUQsuqFm4oIh3ZCmJ1xWoJT4Lh69vk1Q6k5g/Qgo0XAs/K55ZsIh1ZCmI0iRTAMDvXkudX2VPU5ncgKEfAs/4fShnkxlEYQgZvhuEPk2dVZkemjRcbFBNEY+c1wJ4BKhE9BHwOwQhFAKFllCYSYdq4o4wjTfnHTh0VgNE3cM7dlXIk3WWStCBTEk1XuQCE+/h8Ng7VzTU+ahAAAAABJRU5ErkJggg==',
            'compPemilik' => 'Prof Siap Sehat S, Teh',
        ]);
    }
}
