import { useAuth0 } from "@auth0/auth0-react"

export const useAuthFetch  = ()=>{
    const {getAccessTokenSilently} = useAuth0();

    const authFetch = async (url: string, options: RequestInit = {}) => {
        const token = await getAccessTokenSilently();
        return fetch(url, {
        ...options,
        headers: {
            "Content-Type": "application/json",
            ...options.headers,
            Authorization: `Bearer ${token}`,
        },
        });
    };

    return {authFetch}

}